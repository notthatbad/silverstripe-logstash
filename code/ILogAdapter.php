<?php

/**
 * Interface ILogAdapter
 * @author Christian Blank <c.blank@notthatbad.net>
 */
interface ILogAdapter {

    /**
     * @return string
     */
    public function host();

    /**
     * @return int
     */
    public function port();
}