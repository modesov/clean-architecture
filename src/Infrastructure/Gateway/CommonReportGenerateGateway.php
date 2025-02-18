<?php

namespace App\Infrastructure\Gateway;

use App\Application\Dto\NewsDto;
use App\Application\Gateway\ReportGenerateGateway\ReportGenerateGatewayInterface;
use App\Application\Gateway\ReportGenerateGateway\ReportGenerateGatewayRequest;
use App\Application\Gateway\ReportGenerateGateway\ReportGenerateGatewayResponse;

class CommonReportGenerateGateway implements ReportGenerateGatewayInterface
{

    public function reportGenerate(ReportGenerateGatewayRequest $request): ReportGenerateGatewayResponse
    {
        $reportHtml = $this->prepareReport($request->news);
        $reportName = date('YmdHis') . '.html';
        $path = __DIR__ . "/../../../public/reports/$reportName";
        file_put_contents($path, $reportHtml);
        return new ReportGenerateGatewayResponse("/reports/$reportName");
    }

    /**
     * @param NewsDto[] $news
     * @return string
     */
    private function prepareReport(array $news): string
    {
        $html = '<ul>';

        /**
         * @param NewsDto $item
         */
        foreach ($news as $item) {
            $html .= "<li><a href='{$item->url}'>{$item->name}</a></li>";
        }

        $html .= '</ul>';

        return $html;
    }
}