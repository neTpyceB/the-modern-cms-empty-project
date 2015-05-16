<?php

namespace neTpyceB\Tests\TMCms\DB;

use Exception;
use neTpyceB\TMCms\DB\Transaction;
use neTpyceB\TMCms\DB\TransactionFactory;

class TransactionFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCanGetDefaultTransaction() {
        $transaction = TransactionFactory::getDefault();
        $this->assertTrue($transaction instanceof Transaction);
    }

    public function testCanGetTransactionByLabel() {
        $transaction = TransactionFactory::getByLabel('retryable');
        $this->assertTrue($transaction instanceof Transaction);
    }

    public function testCanSetConfigFromSource() {
        $transaction = TransactionFactory::getByLabel('retryable');
        $this->assertTrue($transaction->isRetryOnDeadlockEnabled());
    }

    public function testCanMakeFromClosure() {
        $closure = function() {
            $a = "Hi there, i'm a closure =)\n";
        };
        $transaction = TransactionFactory::make($closure);
        $this->assertEquals($closure, $transaction->getClosure());
    }

    public function testCanExecuteClosure() {
        $testValue = 2;
        $transaction = TransactionFactory::make(function() use (&$testValue) {
            $testValue = 3;
        });
        $transaction->executeClosure();
        $this->assertEquals($testValue, 3);
    }

    public function testCanRunTransaction() {
        $testValue = 2;
        $transaction = TransactionFactory::make(function() use (&$testValue) {
            $testValue = 3;
        });
        $transaction->run();
        $this->assertEquals($testValue, 3);
    }

    public function testCanAutoRunTransaction() {
        $testValue = 2;
        TransactionFactory::run(function() use (&$testValue) {
            $testValue = 3;
        });
        $this->assertEquals($testValue, 3);
    }

    public function testCanCheckForSuccessfulTransaction() {
        $transaction = TransactionFactory::run(function() {
            $a = "Hi there, i'm a closure =)\n";
        });
        $this->assertTrue($transaction->isOk());
    }

    public function testCanCheckForFailedTransaction() {
        $transaction = TransactionFactory::run(function() {
            throw new Exception('test exception, do not mind', Transaction::ERR_CODE_SERIALIZATION);
        });
        $this->assertFalse($transaction->isOk());
    }

    public function testCanRetryFailedTransaction() {
        $transaction = TransactionFactory::run(function() {
            throw new Exception('test exception, do not mind', Transaction::ERR_CODE_WAITING);
        }, 'retryable');
        $this->assertEquals($transaction->getTotalTries(), 1 + $transaction->getMaxRetries());
    }
}