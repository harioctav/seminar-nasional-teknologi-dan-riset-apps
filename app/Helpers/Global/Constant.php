<?php

namespace App\Helpers\Global;

class Constant
{
  // Role Name
  public const ADMIN = 'Administrator';
  public const REVIEWER = 'Reviewer';
  public const PEMAKALAH = 'Pemakalah';
  public const PARTICIPANT = 'Peserta';

  public const DEFAULT_PASSWORD = 'password';

  // Gender Name
  public const MALE = 'Laki - Laki';
  public const FEMALE = 'Perempuan';

  public const YES = 'Ya';
  public const NO = 'Tidak';

  // Status
  public const ALL = 'Semua Status';
  public const ACTIVE = 1;
  public const INACTIVE = 0;
  public const PENDING = 'Pending';
  public const APPROVED = 'Approved';
  public const REJECTED = 'Rejected';
}
