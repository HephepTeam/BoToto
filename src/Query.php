<?php

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
