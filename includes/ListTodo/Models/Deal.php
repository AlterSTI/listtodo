<?php

namespace ListTodo\Models;

use DateTime;
use Throwable;
use RuntimeException;

class Deal
{
    private $id = 0;
    private $dateTime = null;
    private $comment = '';

    /**
     * @param int $id
     * @param DateTime $dateTime
     * @param string $comment
     *
     * @throws RuntimeException
     */
    public function __construct(int $id, DateTime $dateTime = null, string $comment = '')
    {
        try {
            $this->dateTime = !is_null($dateTime) ? $dateTime : new DateTime('now');
        } catch (Throwable $exception) {
            throw new RuntimeException('Error create new DealObject', 0, $exception);
        }
        $this->id = $id;
        $this->comment = $comment;
    }

    /**
     * get deal id
     *
     * @return int deal id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * get deal dateTime
     *
     * @return DateTime deal dateTime
     */
    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }

    /**
     * get deal comment
     *
     * @return string deal id
     */
    public function getComment(): string
    {
        return $this->comment;
    }
}