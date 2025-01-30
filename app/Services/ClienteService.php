<?php
namespace App\Services;

use App\Models\Cliente;

class ClienteService
{
    /**
     * Obtener clientes filtrados.
     *
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilteredClients(array $filters)
    {
        $query = Cliente::query();

        if (isset($filters['nombre'])) {
            $query->where('nombre_completo', 'LIKE', "%{$filters['nombre']}%");
        }

        if (isset($filters['email'])) {
            $query->where('email', $filters['email']);
        }

        if (isset($filters['id_tipo_cliente'])) {
            $query->where('id_tipo_cliente', $filters['id_tipo_cliente']);
        }

        return $query->get();
    }
}
