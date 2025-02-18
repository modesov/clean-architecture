<?php

namespace App\Application\Gateway\ReportGenerateGateway;


interface ReportGenerateGatewayInterface
{
    public function reportGenerate(ReportGenerateGatewayRequest $request): ReportGenerateGatewayResponse;
}