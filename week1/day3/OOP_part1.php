<?php

enum Currency: string {
    case NGN = "NGN";
    case USD = "USD";
    case EUR = "EUR";
    case GBP = "GBP";
}

enum Status: string {
    case DRAFT = "draft";
    case SENT = "sent";
    case PAID = "paid";
}

class LineItem {
    private float $total;

    public function __construct(
        private string $product,
        private int $quantity,
        private float $price,
        private Currency $currency
    ) {
        $this->total = 0;

        if ($quantity <= 0) {
            throw new InvalidArgumentException("quantity must be greater than zero");
        }

        if ($price < 0) {
            throw new InvalidArgumentException("price can not be negative");
        }
    }

    private function calculateTotal(): void {
        $this->total = $this->price * $this->quantity;
    }

    public function getTotal(): string {
        $this->calculateTotal();
        return "{$this->currency} {$this->total}";
    }

    public function getProduct(): string {
        return $this->product;
    }

    public function changeCurrency(string $currencyCode): void {
        if (($this->currency = Currency::tryFrom($currencyCode)) === null) {
            throw new InvalidArgumentException("invalid currency code");
        }   //idk about this
    }
}

$lineItem1 = new LineItem("lappy", 1, 1_099, Currency::NGN);
echo $lineItem1->getTotal();


class Invoice {
    public readonly DateTimeImmutable $dueDate;
    public readonly float $total;
    /** 
     * @var LineItem[]
     */
    private array $lineItems;


    public function __construct(
        public readonly string $id,
        public readonly string $customer,
        private Status $status = Status::DRAFT
    ) {
        $this->lineItems = [];
        $this->dueDate = new DateTimeImmutable("now");
        $this->total = 0;
    }

    private function calculateTotal(): void {   //helper function
        $this->total = array_sum(
                        array_map(
                            fn(LineItem $lineItem) => $lineItem->getTotal(), 
                        $this->lineItems
                        )
                    );
    }

    public function addLineItem(LineItem $lineItem): void {
        array_push($this->lineItems, $lineItem);
        $this->calculateTotal();
    }

    public function getLineItems(): array {
        return $this->lineItems;
    }

    public function getStatus(): Status {
        return $this->status;
    }

    public function markStatusAs(string $status): void {
        $this->status = match (strtolower(trim($status))) {
            "draft" => Status::DRAFT,
            "sent" => Status::SENT,
            "paid" => Status::PAID,
            default => throw new InvalidArgumentException("invalid status"),
        };
    }
}

$invoice = new Invoice("inv001", "tomi");
$invoice->addLineItem($lineItem1);
echo $invoice->id; // can read but cannot modify


class MathHelper {
    public static float $PI = 3.14; // accessible by the class itself with ::

    public static function add(int $a, int $b): int {
        return $a + $b;
    }

    public static function areaOfCircle(float $radius): float {
        return self::$PI * ($radius ** 2);
        // can only use static properties inside static methods, $this is not allowed
        // same as MathHelper::$PI
    }
}

echo MathHelper::add(1, 2);
echo MathHelper::$PI;
