<?php

require_once('classes/models/Model.php');

class Player extends Model{

    public $searchArgs = ['player', 'playerId', 'team', 'position', 'country'];

    public function search($search) {
        $where = [];
        if ($search->has('playerId')) $where[] = "roster.id = '" . $search['playerId'] . "'";
        if ($search->has('player')) $where[] = "roster.name = '" . $search['player'] . "'";
        if ($search->has('team')) $where[] = "roster.team_code = '" . $search['team']. "'";
        if ($search->has('position')) $where[] = "roster.position = '" . $search['position'] . "'";
        if ($search->has('country')) $where[] = "roster.nationality = '" . $search['country'] . "'";
        $where = implode(' AND ', $where);
        $sql = "
            SELECT roster.*
            FROM roster
            WHERE $where";
        return collect(query($sql))
            ->map(function($item, $key) {
                unset($item['id']);
                return $item;
            });
    }
}