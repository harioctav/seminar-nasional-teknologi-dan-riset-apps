<?php

namespace App\Helpers\Global;

class Constant
{
  // Role Name
  public const ADMIN = 'Administrator';
  public const REVIEWER = 'Reviewer';
  public const PEMAKALAH = 'Pemakalah';
  public const PARTICIPANT = 'Peserta';

  // Whatsapp Button
  public const ADMIN_CONTACT = '6285798888733';

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
  public const OPEN = 'Open';
  public const CLOSE = 'Close';

  public const DRAFT = 'Draft';
  public const IN_REVIEW = 'Sedang Review';
  public const IN_REVISION = 'Dalam Revisi';
  public const READY_PUBLISH = 'Siap Diterbitkan';

  public const PUBLISHED = 'Sudah Diterbitkan';
  public const UN_PUBLISHED = 'Belum Diterbitkan';

  // Method
  public const POST = 'POST';
  public const PATCH = 'PATCH';
  public const PUT = 'PUT';

  public const NO_REK = "5410401330";
  public const BANK_NAME = "BANK CENTRAL ASIA";
  public const BANK_USER_NAME = "ADMIN SEMNASTERA";
}
