<?php


namespace App\Repositories\Database;


use App\Models\Person;
use App\Repositories\PersonTokenRepository;
use PDO;

class MySQLPersonTokenRepository implements PersonTokenRepository
{
    private PDO $pdo;
    private string $table = 'tokens';

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function save(Person $person, string $otp): void
    {
        $sql = sprintf(
            "replace into $this->table (code, otp)
                    values ('%s', '%s')",
            $person->code(),
            $otp
        );

        $this->pdo->exec($sql);
    }

    public function getCode(string $otp): ?string
    {
        $sql = "select code from $this->table where otp = '$otp'";
        $statement = $this->pdo->query($sql);
        $code = $statement->fetch();

        if (empty($code)) {
            return null;
        }

        return $code[0];
    }

    public function fetchAdded(string $code): string
    {
        $sql = "select added from $this->table where code = $code";
        $statement = $this->pdo->query($sql);
        return $statement->fetch();
    }

}