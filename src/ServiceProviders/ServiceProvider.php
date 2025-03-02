<?php

namespace FiveGestor\Asaas\ServiceProviders;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use FiveGestor\Asaas\Api\Account;
use FiveGestor\Asaas\Api\Anticipation;
use FiveGestor\Asaas\Api\BillPayment;
use FiveGestor\Asaas\Api\Customer;
use FiveGestor\Asaas\Api\FinancialTransactions;
use FiveGestor\Asaas\Api\FiscalInformation;
use FiveGestor\Asaas\Api\Installment;
use FiveGestor\Asaas\Api\Invoice;
use FiveGestor\Asaas\Api\Notification;
use FiveGestor\Asaas\Api\Payment;
use FiveGestor\Asaas\Api\PaymentDunning;
use FiveGestor\Asaas\Api\PaymentLink;
use FiveGestor\Asaas\Api\Serasa;
use FiveGestor\Asaas\Api\Subscription;
use FiveGestor\Asaas\Api\Webhook;
use FiveGestor\Asaas\Asaas;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the package.
     */
    public function boot()
    {
        /*
        |--------------------------------------------------------------------------
        | Publish the Config file from the Package to the App directory
        |--------------------------------------------------------------------------
        */
        $this->publishes([
            __DIR__ . '/../Config/asaas.php' => config_path('asaas.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../Config/asaas.php';
        $this->mergeConfigFrom($configPath, 'asaas');

        $this->app->bind('asaas.client', function ($app) {
            return new Client();
        });

        $this->app->bind('asaas.functions', function ($app) {
            return [
                'account' => new Account(
                    $app['config'],
                    $app->make('asaas.client')),

                'anticipation' => new Anticipation(
                    $app['config'],
                    $app->make('asaas.client')),

                'billPayment' => new BillPayment(
                    $app['config'],
                    $app->make('asaas.client')),

                'customer' => new Customer(
                    $app['config'],
                    $app->make('asaas.client')),

                'financialTransactions' => new FinancialTransactions(
                    $app['config'],
                    $app->make('asaas.client')),

                'fiscalInformation' => new FiscalInformation(
                    $app['config'],
                    $app->make('asaas.client')),

                'installment' => new Installment(
                    $app['config'],
                    $app->make('asaas.client')),

                'invoice' => new Invoice(
                    $app['config'],
                    $app->make('asaas.client')),

                'notification' => new Notification(
                    $app['config'],
                    $app->make('asaas.client')),

                'payment' => new Payment(
                    $app['config'],
                    $app->make('asaas.client')),

                'paymentDunning' => new PaymentDunning(
                    $app['config'],
                    $app->make('asaas.client')),

                'paymentLink' => new PaymentLink(
                    $app['config'],
                    $app->make('asaas.client')),

                'serasa' => new Serasa(
                    $app['config'],
                    $app->make('asaas.client')),

                'subscription' => new Subscription(
                    $app['config'],
                    $app->make('asaas.client')),

                'webhook' => new Webhook(
                    $app['config'],
                    $app->make('asaas.client')),
            ];
        });

        $this->app->bind('asaas.wrapper', function ($app) {
            $functions = $app->make('asaas.functions');
            return new Asaas(
                $functions['account'],
                $functions['anticipation'],
                $functions['billPayment'],
                $functions['customer'],
                $functions['financialTransactions'],
                $functions['fiscalInformation'],
                $functions['installment'],
                $functions['invoice'],
                $functions['notification'],
                $functions['payment'],
                $functions['paymentDunning'],
                $functions['paymentLink'],
                $functions['serasa'],
                $functions['subscription'],
                $functions['webhook']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['asaas.wrapper'];
    }
}
