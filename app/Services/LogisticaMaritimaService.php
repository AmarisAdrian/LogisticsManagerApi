<?php
namespace App\Services;

use App\Models\LogisticaMaritima;

class LogisticaMaritimaService
{
    /**
     * Obtener clientes filtrados.
     *
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFiltered(array $filters)
    {
        $query = LogisticaMaritima::query();

        if (isset($filters['numero_flota'])) {
            $query->where('numero_flota', 'LIKE', "%{$filters['numero_flota']}%");
        }
        if (isset($filters['numero_guia'])) {
            $query->where('numero_guia', 'LIKE', "%{$filters['numero_guia']}%");
        }

        if (isset($filters['id_puerto'])) {
            $query->where('id_puerto', $filters['id_puerto']);
        }

        if (isset($filters['id_cliente'])) {
            $query->where('id_cliente', $filters['id_cliente']);
        }

        return $query->get();
    }
}
