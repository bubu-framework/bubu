# Guide

## Error code

457: Username or password invalid

458: All fields have not been completed

## Session

SESSION_DURATION=1 equal to 1 day

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


### incluable forlder

The incluable folder has not access security, so, don't put sensitives data!