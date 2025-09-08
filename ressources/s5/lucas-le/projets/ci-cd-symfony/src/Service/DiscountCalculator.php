<?php

namespace App\Service;

class DiscountCalculator
{
    /**
     * Calcule le montant de la remise à appliquer.
     *
     * Règles :
     * - 10% si totalAmount > 100
     * - +5% si client VIP
     * - Remise totale plafonnée à 20% du montant
     */
    public function calculateDiscount(float $totalAmount, bool $isVipCustomer): float
    {
        // Sécurité : pas de remise si montant non positif
        if ($totalAmount <= 0.0) {
            return 0.0;
        }

        $discount = 0.0;

        // 10% si strictement supérieur à 100 €
        if ($totalAmount > 100.0) {
            $discount += $totalAmount * 0.10;
        }

        // +5% pour VIP (indépendant du seuil des 100 €)
        if ($isVipCustomer) {
            $discount += $totalAmount * 0.05;
        }

        // Plafond : 20% du montant total
        $maxDiscount = $totalAmount * 0.20;

        return min($discount, $maxDiscount);
    }
}
