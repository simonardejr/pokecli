# PokeCLI

PokeCLI is a example app built using [Minicli](https://github.com/minicli/minicli). Minicli is an experimental dependency-free toolkit for building CLI-only applications in PHP created by [@erikaheidi](https://github.com/erikaheidi).

## Getting Started

To get started, you'll need:
- php-cli 
- ext-curl [How to install on Linux](https://stackoverflow.com/a/22618953)
- [Composer](https://getcomposer.org/) 
 
Just clone this repo using:

```bash
git clone https://github.com/simonardejr/pokecli.git
```

And run composer install:
```bash
composer install
```

Once the clone and installation is finished, you can run `pokecli` it with:

```bash
cd pokecli
./minicli pokemon fetchinfo name="bulbasaur"
```

If that doesn't work for you, you may have to use instead:

```bash
cd pokecli
php minicli pokemon fetchinfo name="bulbasaur"
```
This will show you the info of chosen Pokemon.

For more details on how to use Minicli, please refer to the [official documentation](https://docs.minicli.dev/en/latest/).
