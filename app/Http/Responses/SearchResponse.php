<?php


namespace App\Http\Responses;


use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchResponse
{
    protected array $searchResult = [];
    protected int $status = Response::HTTP_NOT_FOUND;

    /**
     * Сеттер для контента ответа
     * @param array $results
     */
    public function setResults(array $results):void
    {
        $this->searchResult = $results;
    }

    /**
     * Возвращает http-ответ
     * @return Response
     */
    public function getResponse(): Response
    {
        $this->checkContent();
        return response($this->searchResult, $this->status);
    }

    public function __toString()
    {
        return $this->getResponse()->send();
    }

    /**
     * Проверяет, есть ли в результатах поиска хотя бы один элемент мебели.
     * Если истина, меняет http-статус ответа
     */
    protected function checkContent(): void
    {
        // Для поиска мебели по дате
        if (isset($this->searchResult['rooms'])) {
            foreach ($this->searchResult['rooms'] as $room) {
                if (isset($room['items']) && !empty($room['items']) ) {
                    $this->status = Response::HTTP_OK;
                }
            }
        }

        // Для показа всей мебели в квартире
        if (isset($this->searchResult['history']) && ($this->searchResult['history'] instanceof LengthAwarePaginator) && $this->searchResult['history']->total() > 0 ) {
            $this->status = Response::HTTP_OK;
        }
    }

}
