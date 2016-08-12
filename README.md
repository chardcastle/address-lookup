# Technical Test Response (part 2 of 2)

This work was prepared and written by Chris Hardcastle in response to the brief below.
The work was briefed as a technical test.

## Brief

This work is the result of my answer to the technical test as briefed below:

Using the Google Map Geocoding API (documentation here: https://developers.google.com/maps/documentation/geocoding/start), write some code, that will be able to, as a minimum:

a)	Accept an address as a command line argument.
b)	Call the API with the given address.
c)	Get the response.
d)	Parse the response, and extract the:
	1.	full postal code, if it exists, or partial postal code, if it exists
	2.	The place id.
	3.	The latitude and longitude of the given address.
e)	Append the extracted data to a CSV file.

Some pointers:

1. Although the developer docs say you need a key, you should be able to call the API without needing a key, for example, if you open this link in your browser, it should work: https://maps.googleapis.com/maps/api/geocode/json?address=8+Cambridge+Road,Hove  If you are unable to query it without a key, then feel free to code as if someone should provide their key to the program.

2. Your code should be well documented.

3. Your code should demonstrate good coding principles.

4. You are free to code it however you wish, but we would like some notes explaining any decisions you made e.g. structure of your code, why you chose to use a particular library, design pattern, and so on.


## Assumptions

A number of assumptions were made on the brief:

* The script should handel cases where no results were found.
* No frontend is required for this work.
* It's a good opportunity to demonstrate some test driven development.


## Test instructions

Install and run composer in the same document root directory, this provides
everything required to run:

> phpunit tests/

At this present time of writing:
3 tests and 7 assertions (all) passed in 473 milliseconds, using 15.75MB of memory.

Any feedback is gratefully received. Please visit www.chrishardcastle.co.uk for more information.

Thanks for your interest in my work and taking a look at technical test result.

