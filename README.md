# PGODB SDK Laravel

Laravel SDK for Prosecutor General's Office's Criminal Justice Sector database.

## Installation

You can install the package via composer:

```bash
composer require javaabu/pgodb-sdk-laravel
```
### Setting up PGODB Credentials
Add your personal access token for the PGODB system as well as the base URL to your `config/pgodb.php`:

```php
// config/pgodb.php 
... 
'api_key' => env('PGODB_API_KEY'),
'base_uri' => env('PGODB_BASE_URI')    
...
```

## Usage

Using the App container:
``` php
$pgodb = App::make('pgodb-api');
$criminal_case = $pgodb->criminalCase()->find('376/2022');
```
Using the Facade
```php 
use PgoDbAPI;

$criminal_case = PgoDbAPI::criminalCase()->find('376/2022');
```
### Available Methods
This package serves as a thin wrapper around the [PGODB SDK](https://github.com/Javaabu/pgodb-sdk) package. 

### Retrieve all Models
```php
PgoDbAPI::criminalCase()->get();
```
#### Retrieve by Id
We do not use database ids, but rather administrative identification strings such as an individual's
national identity card number, passport number, registration number (for judges and lawyers), incident reference numbers, gaziyyah numbers and the like.

```php
PgoDbAPI::criminalCase()->find($idString);
```
This is a wrapper for the `filter` functionality built into this package.
An alternate way of doing this is as follows:
```php
PgoDbAPI::criminalCase()->addFilter("search", $idString)->get();
```
The search term would change depending on the model being retrieved. The `find` function
abstracts this complexity away for the user.

#### Store Non-Nested Model

```php
// Sample data  
$data = [
    "incident_reference_number": "2123756022",
    "institution_reg_no": "pgo",
    "incident_at": "1996-12-30T09:11:26.000000Z",
    "lodged_at": "1998-03-13T19:00:00.000000Z"
];

PgoDbAPI::criminalCase()->store($data);
```

#### Store Nested Model

```php
// Sample data  
$data = [
    "individual": [
        "nid": "A169993",
        "name": "Dr. Larissa Stokes",
        "name_en": "Mr. Benedict Lockman I",
        "gender": "female",
        "mobile_number": "860.660.2765",
        "nationality_code": "MV",
        "permanent_address_country_code": "MV",
        "permanent_address_city_code": "LD0894",
        "permanent_address": "67353 Rebeka Road\nEast Opal, PA 94709",
        "individual_type": "local",
        "dob": "1995-07-14T19:00:00.000000Z",
        "email": "pemmerich@example.net"
    ]
];

PgoDbAPI::criminalCase()
      ->whereId("7/2022")
      ->complainant()
      ->store($data);
```

#### Update Non-Nested Model

```php
// Sample data  
$data = [
    "institution_reg_no": "javaabu",
];

PgoDbAPI::criminalCase()
      ->whereId("2123756022")
      ->update($data);
```

#### Update Nested Model

```php
// Sample data  
$data = [
    "individual": [
        "permanent_address_country_code": "MV",
    ]
];

PgoDbAPI::criminalCase()
      ->whereId("7/2022")
      ->complainant()
      ->whereId("A169993")
      ->update($data);
```

#### Sorting
```php
PgoDbAPI::criminalCase()
      ->addSort("created_at")
      ->addSortByDesc("updated_at")
      ->get()
````

### Ending Functions
The ending functions of each of these chained functions are defined as follows.
The actual API request will be sent once these ending functions are called at the end of the chain.

-   `get()` Should return a list of items,
-   `find($id)` Should return a single item,
-   `delete($id)` Sends a delete request and returns true or false,
-   `store($data)` Returns the newly stored record,
-   `update($data)` Returns the updated record.




## Credits

- [Ibrahim Hussain Shareef](https://github.com/Javaabu)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
