<?php

namespace App\Classes\Integrations\Yclients;

use Illuminate\Support\Facades\Log;
use App\User;
use App\Entry;
use App\Classes\DTO\UserDTO;
use App\Classes\DTO\EntryDTO;

/**
 * Class YclientsManager
 * @package App\Classes\Integrtions\Yclients
 */
class YclientsManager
{
    /**
     * @var array
     */
    protected $requestArray;

    /**
     * YclientsManager constructor.
     * @param array $requestArray
     */
    public function __construct(array $requestArray)
    {
        $this->requestArray = $requestArray;
    }

    /**
     *
     */
    public function handle()
    {
        $this->logger(json_encode($this->requestArray));

        $data = $this->requestArray['data'];
        $status = $this->requestArray['status'];

        //Получаем пользователя
        $client = $data['client'];
        $user = User::where('phone', $client['phone'])->first();

        if (empty($user)) {
            $userDTO = $this->storeClient($client['name'], $client['phone']);
        } else {
            $userDTO = new UserDTO($user);
        }

        $params = [
            'external_id' => $data['id'],
            'user' => $userDTO->getModel(),
            'visited_date' => $data['date'],
        ];

        $entryDTO = $this->storeEntry($params);

        dd($entryDTO->getExternalId());
        //Сохраняем запись
    }

    /**
     * @param string $name
     * @param string $phone
     * @return UserDTO
     */
    protected function storeClient(string $name, string $phone)
    {
        $dto = new UserDTO;
        $dto->setName($name);
        $dto->setPhone($phone);
        $dto->store();

        return $dto;
    }

    protected function storeEntry(array $params)
    {
        $entry = Entry::where('external_id', $params['external_id'])
            ->first();

        $dto = new EntryDTO($entry);

        if (isset($params['external_id'])) {
            $dto->setExternalId($params['external_id']);
        }

        if (isset($params['user'])) {
            $dto->setUserId($params['user']);
        }

        if (isset($params['visited_date'])) {
            $dto->setVisitedDate($params['visited_date']);
        }

        $dto->store();

        return $dto;
    }

    /**
     * @param string $log
     */
    protected function logger(string $log)
    {
        Log::info($log);
    }
}
