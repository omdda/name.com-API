# Class name.com PHP
* This class is simple and can be developed according to your needs

### Basic usage

```PHP
$nameAPI = new nameAPI();

$result  = $nameAPI->search("example.org");
$result  = $nameAPI->info("example.org");
$result  = $nameAPI->getPricing("example.org");
$result  = $nameAPI->checkAvailability("example.org");

print_r($result);
```