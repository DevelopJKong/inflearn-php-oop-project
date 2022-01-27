<?php

namespace php_oop_board\Session;
use php_oop_board\Database\Adaptor;


class DatabaseSessionHandler implements \SessionHandlerInterface
{
    public function open($savePath, $sessionName)
    {
        return true;
    }

    public function close()
    {
        return true;
    }

    public function read($id)
    {
        //adapter class에 종속이 되어있다 이 말은 정확히 무슨 뜻이지?
        $data = current(Adaptor::getAll('SELECT * FROM sessions WHERE `id` = ?', [$id]));
        if ($data) {
            $payload = $data->payload;
        } else {
            Adaptor::exec('INSERT INTO sessions(`id`) VALUES(?)', [$id]);
        }
        return $payload ?? '';
    }

    public function write($id, $payload)
    {
        return Adaptor::exec('UPDATE sessions SET `payload` =? WHERE `id` =? ',[$payload,$id]);
    }

    public function destroy($id)
    {
        return Adaptor::exec('DELETE FROM sessions HWERE `id` = ?',[$id]);
    }

    public function gc($maxlifetime)
    {
        if($sessions = Adaptor::getAll('SELECT * FROM sessions')) {
            foreach($sessions as $session) {
                $timestamp = strtotime($session->created_at);
                if(time() - $timestamp > $maxlifetime) {
                    $this->destroy($session->id);
                }
            }
            return true;
        }
        return false;
    }
}