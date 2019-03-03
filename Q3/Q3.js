/**
 * The expected output for the provided code would be to print the numbers
 * 1 through 5, one at a time, with a second between each print.
 *
 * The first reason as to why it is not working as expected is because we need
 * to 'snapshot' the value we want to print when creating the closure for
 * the setTimeout() function. Without this 'snapshot', when the setTimeout()
 * function is called the i variable has already been mutated via the for loop,
 * resulting in '6' being printed 5 times.
 *
 * To do this, we should add a single parameter to the closure inside the
 * setTimeout() function. Second, we should let setTimeout() know which
 * value we want this passed-in parameter to be by using optional third
 * parameter of setTimeout().
 *
 *
 * The second reason I see as to why it is not working as expected is the timing.
 * We set a 1 second delay on all the setTimeout() calls, which is cool, but the for loop completes
 * so fast that the values end up being printed (seemingly) at the same time.
 *
 * To solve this, we should use delay the setTimeout() call an extra second for every value
 *
 * To display our expected results, the code should be written similar to:
 */

for (var i=1; i<=5; ++i) {
    setTimeout((i) => console.log(i), i * 1000, i);
}
