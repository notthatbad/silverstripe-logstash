<?php

/**
 * Interface ILogAdapter
 */
interface ILogAdapter
{

    /**
     * @return string
     */
    public function host();

    /**
     * @return int
     */
    public function port();
}
