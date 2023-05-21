<?php

namespace App\Helpers\Global;

class NameAuto
{
  protected $name;

  public function sparate($data)
  {
    $this->name = explode(" ", $data);
    return $this->name;
  }

  public function firstName($data)
  {
    if ($this->sparate($data)) {
      return (!empty($this->name[0]) ? $this->name[0] : '');
    }
  }

  public function secondName($data)
  {
    if ($this->sparate($data)) {
      return (!empty($this->name[1]) ? $this->name[1] : '');
    }
  }

  public function thirdName($data)
  {
    if ($this->sparate($data)) {
      return (!empty($this->name[2]) ? $this->name[2] : '');
    }
  }

  public function fourthName($data)
  {
    if ($this->sparate($data)) {
      return (!empty($this->name[3]) ? $this->name[3] : '');
    }
  }

  public function countName($data)
  {
    $name = explode(" ", $data);
    $name = count($name);
    return $name;
  }

  public function shortName($data)
  {
    if (self::countName($data) == 1) {
      $name = self::firstName($data);
    } elseif (self::countName($data) == 2) {
      $name = self::firstName($data);
      $name .= " " . substr(self::secondName($data), 0, 1);
    } elseif (self::countName($data) == 3) {
      $name = self::firstName($data);
      $name .= " " . substr(self::secondName($data), 0, 1);
      $name .= " " . substr(self::thirdName($data), 0, 1);
    } else {
      if (self::countName($data) >= 4) {
        $name = self::firstName($data);
        $name .= " " . substr(self::secondName($data), 0, 1);
        $name .= " " . substr(self::thirdName($data), 0, 1);
        $name .= " " . substr(self::fourthName($data), 0, 1);
      }
    }
    return $name;
  }
}
