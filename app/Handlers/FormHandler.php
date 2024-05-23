<?php

namespace App\Handlers;

class FormHandler
{
    public function formatData(array $data): array
    {
        // Formata a data de nascimento de DD/MM/AAAA para AAAA-MM-DD
        if (isset($data['birth_date'])) {
            $data['birth_date'] = $this->formatDate($data['birth_date']);
        }

        if (isset($data['pwd_hash'])) {
            $data['pwd_hash'] = base64_encode($data['pwd_hash']);
        }

        if (isset($data['price'])) {
            $data['price'] = str_replace("R$", "", $data['price']);
            $valor_convertido = str_replace(',', '.', str_replace('.', '', $data['price']));
            $data['price'] = (float) $valor_convertido;
        }

        return $data;
    }

    private function formatDate(string $date): string
    {
        $dateTime = \DateTime::createFromFormat('d/m/Y', $date);
        if ($dateTime === false) {
            throw new \InvalidArgumentException('Data de nascimento inválida.');
        }
        return $dateTime->format('Y-m-d');
    }
}
