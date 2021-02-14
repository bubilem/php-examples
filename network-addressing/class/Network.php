<?php

class Network
{
    private $name;
    private $address;
    private $prefix;
    private $parentPrefix;

    public function __construct($name, AddressIPv4 $address, int $prefix = 32, int $parentPrefix = 0)
    {
        $this->name = $name;
        if ($address->isValid()) {
            $this->address = $address;
        }
        $this->prefix = $prefix > 0 && $prefix <= 32 ? $prefix : 32;
        $this->parentPrefix = $parentPrefix > 0 && $parentPrefix < $prefix ? $parentPrefix : 0;
    }

    public function isValid(): bool
    {
        return $this->address->isValid() && $this->isNetworkAddress();
    }

    public function isNetworkAddress(): bool
    {
        $bin = $this->address->getBinary();
        for ($i = $this->prefix; $i < 32; $i++) {
            if ($bin[$i] != '0') {
                return false;
            }
        }
        return true;
    }

    public function analyze()
    {

        $data = [];
        $data['Name']['dec'] = $this->getName();
        $data['Name']['bin'] = '/' . $this->prefix;
        $mask = new AddressIPv4("255.255.255.255");
        $mask->setBit('0', $this->prefix + 1, 32);
        $data['Mask']['dec'] = $mask->renderDecimal($this->prefix);
        $data['Mask']['bin'] = $mask->renderBinary($this->prefix, $this->parentPrefix);
        $data['Network']['dec'] = $this->address->renderDecimal($this->prefix);
        $data['Network']['bin'] = $this->address->renderBinary($this->prefix, $this->parentPrefix);
        if ($this->prefix < 1 || $this->prefix > 31) {
            return $data;
        }
        $broadcast = new AddressIPv4($this->address->getBinary());
        $broadcast->setBit('1', $this->prefix + 1, 32);
        if ($this->prefix <= 30) {
            $first = $this->address->getNextAddress(1);
            $last = $broadcast->getNextAddress(-1);
            $data['First host']['dec'] = $first->renderDecimal($this->prefix);
            $data['First host']['bin'] = $first->renderBinary($this->prefix, $this->parentPrefix);
            $data['Last host']['dec'] = $last->renderDecimal($this->prefix);
            $data['Last host']['bin'] = $last->renderBinary($this->prefix, $this->parentPrefix);
        }
        $data['Broadcast']['dec'] = $broadcast->renderDecimal($this->prefix);
        $data['Broadcast']['bin'] = $broadcast->renderBinary($this->prefix, $this->parentPrefix);
        $data['Host count']['dec'] = pow(2, 32 - $this->prefix) - 2;
        $data['Host count']['bin'] = '';

        return $data;
    }

    public function show()
    {
        echo '<table class="network">';
        foreach ($this->analyze() as $key => $val) {
            echo '<tr>';
            echo '<td>' . $key . '</td>';
            echo '<td>' . $val['dec'] . '</td>';
            echo '<td>' . $val['bin'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getNetworkAddress()
    {
        return $this->address;
    }
}
