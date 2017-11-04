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

class Query
{
    protected $at = '';

    protected $keywords = [];

    protected $hashtags = [];

    /**
     * @param $at
     * @return Query
     */
    public function at(string $at): Query {
        $this->at = '@' . $at;

        return $this;
    }

    public function build() {
        return $this->at;
    }
}
