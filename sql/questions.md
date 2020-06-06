# SQL

![](images/sql-diagram.png)

## 1. Query

Based on the SQL diagram above, write the following queries:

**A.** Get authors with a last name beginning with "M" or who are born after 1950.

**Answer:**
```mysql
# Answer here
SELECT A.first_name, A.last_name, A.birth_date
FROM author A
WHERE A.last_name LIKE 'M%'
   OR YEAR(A.birth_date) > 1950;
```

**B.** Count the number of books per category (empty categories too).

**Answer:**
```mysql
# Answer here
SELECT C.id, C.name, 
       COUNT(B.id) AS books_count
FROM category C
         LEFT JOIN book B ON B.category_id = C.id
GROUP BY B.category_id;
```

**C.** Find authors who wrote at least 2 books.

**Answer:**
```mysql
# Answer here
SELECT A.id, A.first_name, A.last_name,
       COUNT(B.id) books_write
FROM author A
    JOIN book B ON B.author_id = A.id
GROUP BY A.id
HAVING books_write >= 2
```

**D.** Get 50 authors with at least one event between the start and the end of this year.

**Answer:**
```mysql
# Answer here
SELECT A.id, A.first_name, A.last_name,
       COUNT(AE.event_id) AS events_count
FROM author_event AE
         JOIN author A ON A.id = AE.author_id
         JOIN event E on E.id = AE.event_id
WHERE YEAR(E.date) = YEAR(NOW())
LIMIT 50;
```

**E.** Get the average number of books written by authors.

**Answer:**
```mysql
# Answer here
SELECT AVG(books_write)
FROM (
    SELECT COUNT(B.id) books_write
      FROM author A
               JOIN book B ON B.author_id = A.id
      GROUP BY A.id
) as author_books_write
```

**F.** Get authors, sorted by the date of their **latest** event.

**Answer:**
```mysql
# Answer here
SELECT A.id, A.first_name, A.last_name,
       (
           SELECT E.date
           FROM author_event AE
                    LEFT JOIN event E on E.id = AE.event_id
           WHERE AE.author_id = A.id
           ORDER BY E.date DESC
           LIMIT 1
       ) last_event_date
FROM author A
ORDER BY last_event_date DESC
```

## 2. Database Structure

**A.** Based on the SQL diagram above, what can be done to improve the performance of this query ?

```mysql
SELECT id, name FROM book WHERE YEAR(published_date) >= '1973';
```

**Answer:** ?   
By using 1973 integer format instead of 1973 string format to compare.


**B.** Give 3 common good practice on a database structure to optimize queries.

**Answer:** 
 - For searching: Use the search on indexed columns. In addition, the wildcard (%) should be used with care and it is preferable to use the postfix wildcard instead of the full/prefix wildcard.
 - Use the indexes on the columns that will be used for searching, ordering or joining
 - Using data types: prefer varchar instead of text/mediumtext if possible, mediumint instead of int/bigint. Choosing the best type of data and the right sizing.
