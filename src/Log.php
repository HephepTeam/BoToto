<?php
/*
 * (c) Jules-Gil Primo <julesgil.primo@gmail.com>
 *
 * Licensed under the MIT license.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BoToto;

use Carbon\Carbon;

class Log
{
    protected $message;

    protected $time;

    protected $std;

    /**
     * Log constructor.
     * @param string $message
     * @param bool $err
     */
    public function __construct(string $message, $err = false)
    {
        $this->message = $message;
        $this->time = Carbon::now()->toDateTimeString();
        if ($err) {
            $this->std = STDERR;
        } else {
            $this->std = STDOUT;
        }
    }

    public function log()
    {
        fwrite(
            $this->std,
            '[' . $this->time. '] ' . $this->message . "\n"
        );
    }
}