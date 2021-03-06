<?php

declare(strict_types=1);

namespace MyParcelCom\Microservice\Shipments;

use MyParcelCom\JsonApi\Interfaces\MapperInterface;
use MyParcelCom\Microservice\Carrier\CarrierApiGatewayInterface;

class ShipmentRepository
{
    /** @var MapperInterface */
    protected $shipmentMapper;

    /** @var CarrierApiGatewayInterface */
    protected $carrierApiGateway;

    /**
     * Makes a shipment and persists it (by sending it to the PostNL api)
     * from the shipment data posted.
     *
     * @param  array $data
     * @return Shipment
     */
    public function createFromPostData(array $data): Shipment
    {
        /** @var Shipment $shipment */
        $shipment = $this->shipmentMapper->map($data, new Shipment());

        // TODO: Validate the data for this specific carrier.
        // TODO: Map/transform the Shipment to a valid request for the carrier.
        // TODO: Send the shipment to the carrier (use CarrierApiGateway).
        // TODO: Map updated values to the Shipment (barcode, id, etc).
        // TODO: Get files (label, printcode, etc) for the shipment.
        // TODO: Add files to the shipment (use File objects).

        return $shipment;
    }

    /**
     * @param CarrierApiGatewayInterface $carrierApiGateway
     * @return $this
     */
    public function setCarrierApiGateway(CarrierApiGatewayInterface $carrierApiGateway): self
    {
        $this->carrierApiGateway = $carrierApiGateway;

        return $this;
    }

    /**
     * Set mapper to use when mapping request data to a Shipment.
     *
     * @param MapperInterface $mapper
     * @return $this
     */
    public function setShipmentMapper(MapperInterface $mapper): self
    {
        $this->shipmentMapper = $mapper;

        return $this;
    }
}
