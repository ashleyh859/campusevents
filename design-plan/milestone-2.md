# Project 2, Milestone 2: Design Journey

[← Table of Contents](design-journey.md)


**Make the case for your decisions using concepts from class, as well as other design principles, theories, examples, and cases from outside of class (includes the design prerequisite for this course).**

You can use bullet points and lists, or full paragraphs, or a combo, whichever is appropriate. The writing should be solid draft quality.


## Consumer: Filtering by Tag
> Design the URL for filtering by a tag on the view all page for the consumer.
> What is the URL for filtering by a tag?

The URL for filtering by a tag should be /?tag={tag_name}.
Sample URLs could be /?tag=free.

> What query string parameters will you include in the URL?

| Query String Parameter Name       | Description       |
| --------------------------------- | ----------------- |
| tag | The name of the tag to filter events. These include "free", "paid", "social", "educational", "open-event", "private", "weekend", "food", "arts", or "networking" |
|                                   |                   |



## Consumer: Details Page URL
> Design the URL for the consumer's detail page.
> What is the URL for the detail page?

The URL for consumer's detail page should be /event?id={event.id} because there may be many campus orgs hosting similar events (ex. many Mid-Autumn Festivals so URLs may overlap if we actually use title of the event. Also if we use title names, if admin changes their event title then if users saves that URL, it would be a 404 error.).
Sample URLs could be /event?id=1.

> What query string parameters will you include in the URL?

| Query String Parameter Name       | Description       |
| --------------------------------- | ----------------- |
| id | unique ID of the event to display details for (ex. 1, 2, 3, etc.)  |


## Administrator: Filtering by Tag
> Design the URL for filtering by a tag on the administrator's view all page.
> What is the URL for filtering by a tag?

The URL for filtering by a tag should be /admin/?tag={tag_name}.
Sample URLs could be /admin/?tag=free.

> What query string parameters will you include in the URL?

| Query String Parameter Name       | Description       |
| --------------------------------- | ----------------- |
| tag | The name of the tag to filter events. These include "free", "paid", "social", "educational", "open-event", "private", "weekend", "food", "arts", or "networking" |


## Administrator: Edit Page URL
> Design the URL for the administrator's edit page.
> What is the URL for the administrator's edit page?

The URL for admin's edit page should be /admin/edit?id={event.id} because there may be many campus orgs hosting similar events (ex. many Mid-Autumn Festivals so URLs may overlap if we actually use title of the event. Also if we use title names, if admin changes their event title then if users saves that URL, it would be a 404 error.).
Sample URLs could be /admin/edit?id=1.

> What query string parameters will you include in the URL?

| Query String Parameter Name       | Description       |
| --------------------------------- | ----------------- |
| id | unique ID of the event to display details for (ex. 1, 2, 3, etc.)   |


## SQL Query Plan
> Plan the SQL query to retrieve all entry records for a specific tag (i.e. tag 100).

```
SELECT DISTINCT events.*
FROM events
INNER JOIN event_tags ON (events.id = event_tags.event_id)
INNER JOIN tags ON (event_tags.tag_id = tags.id)
WHERE (tags.name = :tag_name);

```

Orginally, I did not use DISTINCT or .* syntax, but I realized there was an issue where when the user selects a tag, and then taps into the details, it would redirect them to another event (event id) since duplicate rows were affecting the event IDs, so I used reference docs (cited) to help me filter out more specific queries.

> Plan the SQL query to retrieve a record (i.e. record 1). (Do not retrieve tags.)

```
SELECT *
FROM events
WHERE (id = :event_id);

```

> Plan the SQL query to retrieve all tag names for record 1.

```
SELECT tags.name AS 'tags.name'
FROM tags
INNER JOIN event_tags ON (tags.id = event_tags.tag_id)
WHERE (event_tags.event_id = :event_id);
```


## References

### Collaborators
> List any persons you collaborated with on this project.

N/A

### Reference Resources
> Did you use any resources not provided by this class to help you complete this assignment? (Do not list the course resources or the Mozilla documentation.)
> List any external resources you referenced in the creation of your project. (i.e. ChatGPT, etc.)
>
> Provide the URL to the resources you used and include a short description of how you used each resource.

- tag with X button https://www.w3schools.com/howto/howto_js_close_list_items.asp
- image file type for forms: https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/file
- SQL DISTINCT statement: https://www.w3schools.com/sql/sql_distinct.asp
- SQL *. so that i can retrieve j columns from this table. My goal was to ensure each event appears only once even if it has multiple matching tags: https://www.sqlite.org/lang_select.html

[← Table of Contents](design-journey.md)
