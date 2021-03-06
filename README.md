# laravel-post

[![Latest Version on Packagist][ico-version]][https://packagist.org/packages/cellv/laravel-posts]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

## Structure

If any of the following are applicable to your project, then the directory structure should follow industry best practises by being named the following.

```
bin/        
config/
src/
test/
vendor/
```


## Install

Via Composer

``` bash
$ composer require cellv/laravel-post
```

## Usage

``` php
$skeleton = new cellv\laravel-post();
echo $skeleton->echoPhrase('Hello, League!');
```


``` blade
@can('view', $post->comments->first())
    @includeIf('post.partials._comments')
@else
    <em><a href="{{ route('login-ajax') }}" class="btn ajax" data-method="post" data-append=".auth-modal">Sign In</a> to read comments</em>
@endcan
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email maxweb@mac.com instead of using the issue tracker.

## Credits

- [Massimo Selvi][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/cellv/laravel-post.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/cellv/laravel-post/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/cellv/laravel-post.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/cellv/laravel-post.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/cellv/laravel-post.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/cellv/laravel-post
[link-travis]: https://travis-ci.org/cellv/laravel-post
[link-scrutinizer]: https://scrutinizer-ci.com/g/cellv/laravel-post/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/cellv/laravel-post
[link-downloads]: https://packagist.org/packages/cellv/laravel-post
[link-author]: https://github.com/massimoselvi
[link-contributors]: ../../contributors
