<?php
require_once('classes/models/Model.php');

class SearchMapper {
    function mapSearchParams(Model $model, $args) {
        $searchArgs = $model->searchArgs;
        $search = $args->filter(function($value, $key) use ($searchArgs) {
            return in_array($key, $searchArgs);
        });
        return $search;
    }
}