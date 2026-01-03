# Project 3, Milestone 3: **Team** Design Journey

[← Table of Contents](design-journey.md)


**Make the case for your decisions using concepts from class, as well as other design principles, theories, examples, and cases from outside of class (includes the design prerequisite for this course).**

You can use bullet points and lists, or full paragraphs, or a combo, whichever is appropriate. The writing should be solid draft quality.



## File Upload - Types of Files
> What types of files will you allow users to upload?
> Can users upload any type of file? Can user only upload one type of file?
> Or can users upload different types of files?
> List the file extensions of the types of files your users may upload.


- .jpg
- .jpeg
- .png

Marcus (admin) should only be allowed to upload still event flyers/photos, and these are the most common still image types, as this is an event catalog that displays visual media for each event.


## File Upload - Updated DB Schema
> Plan any updates you need to make to your database schema to support file uploads.
>
> 1. Copy your project DB Schema for the _entries_ table here.
> 2. Modify the schema to include any file upload information you desire to store in your database.
>    If you don't need to modify anything, explain why.

Milestone 1: events
- id: INTEGER {PRIMARY KEY, AUTOINCREMENT, NOT NULL, UNIQUE}
- title: TEXT {NOT NULL}
- description: TEXT {NOT NULL}
- time: TEXT {NOT NULL}
- location: TEXT {NOT NULL}
- host_organization: TEXT {NOT NULL}
- image_file: TEXT {NOT NULL}
- image_citation: TEXT {}
```
updated events schema
- id: INTEGER {PRIMARY KEY, AUTOINCREMENT, NOT NULL, UNIQUE}
- title: TEXT {NOT NULL}
- description: TEXT {NOT NULL}
- time: TEXT {NOT NULL}
- location: TEXT {NOT NULL}
- host_organization: TEXT {NOT NULL}
- image_file: TEXT {NOT NULL}
- image_ext: TEXT {NOT NULL}
- image_citation: TEXT {}

```


## File Upload - File Storage
> Plan the file path to store the uploaded files on the server's file system.
> Store the uploaded files in a subfolder of the `public/uploads` folder using the _entries_ table name as the subfolder name.

`public/uploads/events/`


## File Upload - Path and URL
> Assume that a user completed the insert/edit entry form.
> The **id** for the new record is **154**.
>
> 1. Plan the file system path to store the uploaded file.
> 2. Plan the URL to load the uploaded file in your website's HTML.

**File System Storage Path:**

```
public/uploads/events/154.jpg
```
Note: the actual extension depends on the image file (jpg, jpeg, or png), and this would be stored in "image_ext" field.

**Resource URL:**

```
<picture>
  <img src="/public/uploads/events/154.jpg">
</picture>

```
Note: the actual extension depends on the image file (jpg, jpeg, or png), and this would be stored in "image_ext" field.
Note: In the actual PHP code, I will code the URL dynamically using the "image_ext" field from the data and concatenate it like $image_url = "/public/uploads/events/" . $event["id"] . "." . $event['image_ext']


## File Upload - Form Input
> Write the HTML of an `<input>` element that allows users to upload a file.
> Limit the types of files that a user may upload.

```html
<input id = "upload-event-image" type= "file" name= "event-image" accept= ".jpeg, .jpg, .png">
```


## File Upload - PHP File Upload Data
> Use the `name` attribute of the file input you planned above to plan how you will
> access the uploaded file data in PHP using the `$_FILES` superglobal.

> Write the PHP code to access the uploaded file data from the `$_FILES` superglobal.
> Only include the data you will extract from the `$_FILES` superglobal. For example, the file name.
> Hint: <https://www.php.net/manual/en/features.file-upload.post-method.php>

```
$upload = $_FILES["event-image"];

$upload_image_name = basename($upload["name"]);
$upload_image_ext = strtolower(pathinfo($upload_image_name, PATHINFO_EXTENSION));

```


## Insert Form - INSERT query
> Plan your query to insert an entry in your catalog.

```sql

INSERT INTO events
    (title, description, time, location, host_organization, image_file, image_ext)
VALUES
    (:title, :description, :time, :location, :host_organization, :image_file, :image_ext)
```


## Insert Form - Sample Test Data
> Document sample test data to insert an entry in your catalog.
> Upload a sample file to the `design-plan` folder for us to upload when inserting the entry.

**Sample Insert Data:**

- Event Name: Dance Team Spring Showcase 2025
- Description: End-of-semester indoor showcase featuring our team's hard work for the year! Bring your friends and enjoy live performances at Bailey Hall!
- Time: Friday, May 2, 2026 at 7:00 PM
- Location: Bailey Hall
- Host Organization: Cornell University Dance Team

Note: I did not put tags here because the milestone requirement said "Please do not implement tagging or untagging entries." for this milestone.

**Sample Upload File for Event Flyer:** `design-plan/cudt-dance-team-spring-showcase.jpg`
The image file is from https://unsplash.com/photos/a-couple-of-people-that-are-dancing-on-a-stage-KHipnBn7sdY

## Edit Form - UPDATE query
> Plan your query to update an entry in your catalog.

```sql
UPDATE events SET
  title = :title,
  description = :description,
  time= :time,
  location= :location,
  host_organization= :host_organization,
  image_file=:image_file,
  image_ext=:image_ext
WHERE (id=:id);

```


## Edit Form - Sample Test Data
> Document sample test data to edit an entry in your catalog.
> Upload a sample file to the `design-plan` folder for us to upload when editing the entry.

**Sample Edit Data: VSA Lunar New Year Celebration**

- Event Name: VSA Lunar New Year Celebration 2026
- Description: Join the Vietnamese Student Association for our annual Lunar New Year celebration for 2026! Enjoy traditional Vietnamese food, cultural performances, and activities. All students are welcome - no prior knowledge required.
- Time: Saturday, February 10, 2026 at 7:00 PM
- Location: Willard Straight Hall, Memorial Room
- Host Organization: Vietnamese Student Association

**Sample Upload File for Event Flyer:** `design-plan/new-vsa-lunar-new-year.jpg`
This image file is from https://unsplash.com/photos/three-chinese-lanterns-lit-up-in-the-dark-vvKebo3NXEk. (Also note, this image is 1.7MB but it still loads very slow ~30 sec)

## References

### Collaborators
> List any persons you collaborated with on this project.

N/A

### Reference Resources
> Did you use any resources not provided by this class to help you complete this assignment? (Do not list the course resources or the Mozilla documentation.)
> List any external resources you referenced in the creation of your project. (i.e. ChatGPT, etc.)
>
> Provide the URL to the resources you used and include a short description of how you used each resource.

N/A. I cited image files externally on the website as observed in the course policy.

[← Table of Contents](design-journey.md)
