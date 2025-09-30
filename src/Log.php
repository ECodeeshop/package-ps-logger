<?php
namespace Codeeshop\PsModuleLogger;

class Log
{
    private $handle;
    private $logPath;
    private $debugEnabled;

    public function __construct($moduleName, $filename = 'info.log')
    {
        $this->debugEnabled = \Configuration::get(strtoupper($moduleName) . '_DEBUG_STATUS', null, null, null, true);

        if ($this->debugEnabled) {
            $logsDir = _PS_MODULE_DIR_ . $moduleName . '/logs/';
            if (!is_dir($logsDir)) {
                mkdir($logsDir, 0755, true);
            }

            $this->logPath = $logsDir . date('Y-m-d') . '_' . $filename;
            $this->handle = fopen($this->logPath, 'a');
        }
    }

    public function write($message)
    {
        if ($this->debugEnabled && $this->handle) {
            $formattedMessage = date('Y-m-d H:i:s') . ' - ' . print_r($message, true) . "\n";
            fwrite($this->handle, $formattedMessage);
        }
    }

    public function __destruct()
    {
        if ($this->debugEnabled && $this->handle) {
            fclose($this->handle);
        }
    }
}
