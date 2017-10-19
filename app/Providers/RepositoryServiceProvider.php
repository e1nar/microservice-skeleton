<?php declare(strict_types=1);

namespace MyParcelCom\Microservice\Providers;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;
use MyParcelCom\Microservice\Carrier\CarrierApiGatewayInterface;
use MyParcelCom\Microservice\PickUpDropOffLocations\PickUpDropOffLocationRepository;
use MyParcelCom\Microservice\Shipments\ShipmentMapper;
use MyParcelCom\Microservice\Statuses\StatusRepository;
use MyParcelCom\Microservice\Shipments\ShipmentRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PickUpDropOffLocationRepository::class, function (Container $app) {
            return (new PickUpDropOffLocationRepository())
                ->setCarrierApiGateway($app->make(CarrierApiGatewayInterface::class));
        });

        $this->app->singleton(StatusRepository::class, function (Container $app) {
            return (new StatusRepository())
                ->setCarrierApiGateway($app->make(CarrierApiGatewayInterface::class));
        });

        $this->app->singleton(ShipmentRepository::class, function (Container $app) {
            return (new ShipmentRepository())
                ->setShipmentMapper($app->make(ShipmentMapper::class))
                ->setCarrierApiGateway($app->make(CarrierApiGatewayInterface::class));
        });
    }
}
