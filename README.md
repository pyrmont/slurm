Slurm [![Build Status](https://travis-ci.org/pyrmont/slurm.png?branch=master)](https://travis-ci.org/pyrmont/slurm)
=====

Slurm is a plugin for Koken that replaces the boring auto-generated slugs with magical numeric slugs.

Background
----------

After deciding to leave Flickr and host my photos by myself, I settled on [Koken](http://koken.me/) as the CMS best suited to the task. The problem is that Koken enforces a strict type of URL slug, one generated based on the title of the photo or, if that isn't available, the file name. I wanted quasi-random looking numeric slugs, similar to what I had on Flickr.

Caveat
------

Unfortunately, Koken currently requires slugs to include a non-numeric character. Since this requirement is part of the core of the Koken software you have to edit a single file in ```app/site```. A failure to do so results in a being redirected to a 404 page. You will need to edit this file manually each time you upgrade Koken.

Install
-------

In the ```storage/plugins/``` directory, do the following:

```bash
# Clone from this repository.
git clone https://github.com/pyrmont/slurm.git inqk-slurm
```

Then open ```app/site/site.php``` in your favourite text editor, go to line 500 and replace the ```$pattern``` assignments as indicated:

```php
if (@PCRE_VERSION !== 'PCRE_VERSION' && version_compare(PCRE_VERSION, '5.0.0') >= 0)
{
	// $pattern = '\d*[\-_\sa-z\p{L}][\-\s_a-z0-9\p{L}]*';
    $pattern = '[\-\s_a-z0-9\p{L}]+';
}
else
{
	// $pattern = '\d*[\-_\sa-z][\-\s_a-z0-9]*';
    $pattern = '[\-\s_a-z0-9]+';
}
```

In the admin section of your Koken site, navigate to _Settings_ and then choose _Plugins_. Activate the plugin and you're away.

Slurm works by overwriting the slug whenever a photo is added to the library or updated. To change the slugs for existing photos, update the metadata of the photo (such as by changing the caption).

Tests
-----

Run the tests with `phpunit tests`. You'll first need to follow the [PHPUnit installation instructions](http://phpunit.de/manual/3.7/en/installation.html).

Licence
-------

Original work placed in the public domain. All rights are disclaimed.
