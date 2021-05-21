# Guide

## Requirements

- Require php ^7.4
- Require OAuth extension

## Note

For limite recursive call, incluable files can't include other incluable file.

## Error code

457: Username or password invalid

458: All fields have not been completed

## Http

SESSION_DURATION=1 Equal to 1 day

SESSION_CACHE_LIMITER=private Limiter to private mode

HTTP_EXPIRES=60 Equal to 60 minutes

## include

You can change prefix setting in [ExtendHtmlTags](App/ExtendHtmlTags/ExtendHtmlTags.php) file

*Consider `+` for prefix*

- ### css

        `+css('file name')`

- ### js

        `+js('file name')`

- ### file

        `+include('file name')`

- ### picture

        `+picture('file name with extension')`

- ### include variable

        `+||var||` for echo variable with `htmlspecialchars`

        `+|!var!|` for echo variable without `htmlspecialchars`

- ### incluable forlder

        The incluable folder has not access security, so, don't put sensitives data!
