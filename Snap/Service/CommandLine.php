<?php

namespace Snap\Service;

class CommandLine
{
    /**
     * @param string $question
     * @param array $options
     * @param int|null $default
     * @return mixed
     */
    public function ask(string $question, array $options = null, int $default = null)
    {
        $output = $question;

        if (!empty($default)) {
            $output .= " ($default)";
        }

        $output .= PHP_EOL;

        if (!empty($options)) {
            foreach ($options as $key => $option) {
                $optionKey = $key + 1;
                $output .= PHP_EOL;
                $output .= "($optionKey) $option" . PHP_EOL;
            }
        }

        $input = readline($output);

        if (!empty($options) && count($options) && !$this->isInt($input)) {
            return $this->ask($question, $options, $default);
        }

        return $input;
    }

    public function tell($text)
    {
        print($text . PHP_EOL);
    }

    private function isInt($input)
    {
        $input = intval($input);

        if (!is_int($input) || $input === 0) {
            return false;
        }

        return true;
    }
}
