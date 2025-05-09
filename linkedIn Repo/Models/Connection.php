<?php

class Connection {

    private int $connectionId;
    private int $senderId;
    private int $receiverId;
    private string $status;
    private string $sentAt;

    public function getConnectionId(): int {
        return $this->connectionId;
    }

    public function setConnectionId(int $connectionId): void {
        $this->connectionId = $connectionId;
    }

    public function getSenderId(): int {
        return $this->senderId;
    }

    public function setSenderId(int $senderId): void {
        $this->senderId = $senderId;
    }

    public function getReceiverId(): int {
        return $this->receiverId;
    }

    public function setReceiverId(int $receiverId): void {
        $this->receiverId = $receiverId;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function setStatus(string $status): void {
        $this->status = $status;
    }

    public function getSentAt(): string {
        return $this->sentAt;
    }

    public function setSentAt(string $sentAt): void {
        $this->sentAt = $sentAt;
    }
}

?>