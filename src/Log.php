<?php

namespace BoToto;

use Carbon\Carbon;

class Log
{
    protected $message;

    protected $time;

    /**
     * Log constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        $this->message = $message;
        $this->time = Carbon::now()->toDateTimeString();
    }

    /**
     * @param bool $err
     */
    public function log(bool $err = false)
    {
        if ($err) {
            $std = STDERR;
        } else {
            $std = STDOUT;
        }

        fwrite(
            $std,
            '[' . $this->time. '] ' . $this->message . "\n"
        );
    }

    public function errLog()
    {
        $this->log(true);
    }
}