<?php

namespace app\bootstrap;

use app\events\AfterBookCreated;
use app\listeners\AfterBookCreatedListener;
use app\services\smsSender\SmsPilot;
use app\services\smsSender\SmsSender;
use app\useCases\senders\Sender;
use app\useCases\senders\Sms;
use Psr\EventDispatcher\EventDispatcherInterface;
use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\di\Container;
use Yiisoft\EventDispatcher\Dispatcher\Dispatcher;
use Yiisoft\EventDispatcher\Provider\ListenerCollection;
use Yiisoft\EventDispatcher\Provider\Provider;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app): void
    {
        $container = Yii::$container;

        $this->setSenders($container, $app);
        $this->setListeners($container);
    }

    private function setSenders(Container $container, Application $app): void
    {
        $container->setSingleton(SmsSender::class, function () use ($app) {
            return new SmsPilot($app->params['smsPilotApiKey']);
        });

        $container->setSingleton(Sender::class, Sms::class);
    }

    private function setListeners(Container $container): void
    {
        $listeners = (new ListenerCollection())
            ->add(function (AfterBookCreated $event) use ($container) {
                $container->get(AfterBookCreatedListener::class)->handle($event);
            });

        $provider = new Provider($listeners);
        $dispatcher = new Dispatcher($provider);

        $container->setSingleton(EventDispatcherInterface::class, $dispatcher);
    }
}