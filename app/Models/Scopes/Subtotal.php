<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class Subtotal implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $sql = 'SELECT purchases.id AS id
        , items.id AS item_id
        , item_purchase.id AS pivot_id
        , items.price * item_purchase.quantity AS subtotal
        , customers.id AS customer_id
        , customers.name AS customer_name
        , items.name AS item_name
        , items.price AS item_price
        , item_purchase.quantity
        , purchases.status
        , purchases.created_at
        , purchases.updated_at
        FROM purchases
        LEFT JOIN item_purchase ON purchases.id = item_purchase.purchase_id
        LEFT JOIN items ON items.id = item_purchase.item_id
        LEFT JOIN customers ON customers.id = purchases.customer_id
        ';
        $builder->fromSub($sql, 'order_subtotals');
    }
}
