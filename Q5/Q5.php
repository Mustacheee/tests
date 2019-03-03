<?php
/**
 * Issue: Slow load times on pages that displayed data
 *
 * The issue with the slow load times was caused by the fact that we were using Temptable
 * MySQL views to display data to the user. The problem with these views is that they don't
 * utilize the indexes and optimizations we put in place on our tables. So every time the user tries to
 * search for something, we check every row to see if it is a match or not. As more clients signed up, we had more
 * and more data to check every time a user loads the page or initiates a search.
 *
 * Let's say for example you had a set of books in random order. When your teacher asks you to pull out all
 * the books that start with the letter 'C', you have to read every title of every book and determine
 * which ones start with 'C'. Had you alphabetized your book collection, you would know that you only have to
 * look after the books that start with 'B' and as soon as a book starts with 'D', you know your mission
 * is complete.
 *
 * The solution to the issue was to move away from these temptable views and simply run an actual query
 * on the DB, and not a view, when the users load or perform a search. This allows us to take advantage of the indexes,
 * keys, and any other optimizations we put on our tables.
 */