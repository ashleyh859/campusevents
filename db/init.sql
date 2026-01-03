-- database: ../test.sqlite
-- Note: Do not delete the line above! It is helpful for testing your init.sql file.
--
-- TODO: entries, tags, and entry_tags table schemas
-- TODO: seed data
DROP TABLE IF EXISTS "users";

CREATE TABLE "users" (
  "id" INTEGER NOT NULL UNIQUE,
  "name" TEXT NOT NULL,
  "email" TEXT NOT NULL,
  "username" TEXT NOT NULL UNIQUE,
  "password" TEXT NOT NULL,
  PRIMARY KEY("id" AUTOINCREMENT)
);

INSERT INTO
  users ("id", "name", "email", "username", "password")
VALUES
  (
    1,
    'Ashley Huang',
    'ashleyhuang@cornell.edu',
    'ashley.huang',
    '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.' --password: monkey
  );

INSERT INTO
  users ("id", "name", "email", "username", "password")
VALUES
  (
    2,
    'Charity Phillips',
    'charityphillips@cornell.edu',
    'charity.phillips',
    '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.' --password: monkey
  );

DROP TABLE IF EXISTS "sessions";

CREATE TABLE "sessions" (
  "id" INTEGER NOT NULL UNIQUE,
  "user_id" INTEGER NOT NULL,
  "session" TEXT NOT NULL UNIQUE,
  "last_login" TEXT NOT NULL,
  PRIMARY KEY("id" AUTOINCREMENT) FOREIGN KEY("user_id") REFERENCES "users"("id")
);

DROP TABLE IF EXISTS "tags";

DROP TABLE IF EXISTS "event_tags";

DROP TABLE IF EXISTS "events";

CREATE TABLE "events" (
  id INTEGER NOT NULL UNIQUE,
  title TEXT NOT NULL,
  description TEXT NOT NULL,
  time TEXT NOT NULL,
  location TEXT NOT NULL,
  host_organization TEXT NOT NULL,
  image_file TEXT NOT NULL,
  image_ext TEXT NOT NULL,
  image_citation TEXT,
  PRIMARY KEY (id AUTOINCREMENT)
);

INSERT INTO
  "events"(
    "id",
    "title",
    "description",
    "time",
    "location",
    "host_organization",
    "image_file",
    "image_ext",
    "image_citation"
  )
VALUES
  (
    1,
    'VSA Lunar New Year Celebration',
    'Join the Vietnamese Student Association for our annual Lunar New Year celebration! Enjoy traditional Vietnamese food, cultural performances, and activities. All students are welcome - no prior knowledge required.',
    'Saturday, February 10, 2025 at 7:00 PM',
    'Willard Straight Hall, Memorial Room',
    'Vietnamese Student Association',
    'vsa-lunar-new-year.jpg',
    'jpg',
    'https://unsplash.com/photos/a-group-of-hot-air-balloons-8RKZXcDw44U'
  );

INSERT INTO
  "events" (
    "id",
    "title",
    "description",
    "time",
    "location",
    "host_organization",
    "image_file",
    "image_ext",
    "image_citation"
  )
VALUES
  (
    2,
    'Poetry Open Mic Night',
    'Share your original poetry or just come listen to talented student poets. Welcoming environment for all skill levels. Light refreshments provided.',
    'Wednesday, February 12, 2025 at 8:00 PM',
    'Café Jennie',
    'Cornell Poetry Society',
    'cps-poetry-open-mic-night.jpg',
    'jpg',
    'https://unsplash.com/photos/black-and-silver-fountain-pen-hjwKMkehBco'
  );

INSERT INTO
  "events" (
    "id",
    "title",
    "description",
    "time",
    "location",
    "host_organization",
    "image_file",
    "image_ext",
    "image_citation"
  )
VALUES
  (
    3,
    'Free Pizza & Game Night',
    'Unwind with free pizza, board games, and great company. Bring your friends or make new ones!',
    'Friday, February 15, 2025 at 6:00 PM',
    'RPCC Community Room',
    'Residence Hall Council',
    'rhc-free-pizza-game-night.jpg',
    'jpg',
    'https://unsplash.com/photos/vegetable-salad-on-orange-plate-Q9VEWorDhaY'
  );

INSERT INTO
  "events" (
    "id",
    "title",
    "description",
    "time",
    "location",
    "host_organization",
    "image_file",
    "image_ext",
    "image_citation"
  )
VALUES
  (
    4,
    'Study Abroad Info Session',
    'Learn about study abroad opportunities for next year. Hear from students who studied abroad and ask questions about the application process.',
    'Monday, February 18, 2025 at 4:00 PM',
    'Day Hall, Room 114',
    'Cornell Abroad',
    'ca-study-abroad-info-session.jpg',
    'jpg',
    'https://unsplash.com/photos/person-touching-and-pointing-macbook-pro-ZKBzlifgkgw'
  );

INSERT INTO
  "events" (
    "id",
    "title",
    "description",
    "time",
    "location",
    "host_organization",
    "image_file",
    "image_ext",
    "image_citation"
  )
VALUES
  (
    5,
    'Salsa Dancing Lesson',
    'No experience necessary! Learn basic salsa steps from experienced instructors. Come solo or bring a partner.',
    'Thursday, February 20, 2025 at 7:30 PM',
    'Barton Hall',
    'Cornell Ballroom Dance Club',
    'cbdc-salsa-dancing-lesson.jpg',
    'jpg',
    'https://unsplash.com/photos/a-group-of-people-dancing-at-a-party--T7Yw6UZ9uc'
  );

INSERT INTO
  "events" (
    "id",
    "title",
    "description",
    "time",
    "location",
    "host_organization",
    "image_file",
    "image_ext",
    "image_citation"
  )
VALUES
  (
    6,
    'Career Networking Mixer',
    'Connect with alumni working in various industries. Business casual attire recommended. Registration required.',
    'Saturday, February 22, 2025 at 5:00 PM',
    'Career Services Center',
    'Career Services',
    'cc-career-networking-mixer.jpg',
    'jpg',
    'https://unsplash.com/photos/a-group-of-people-standing-in-a-room-yTsy3PYFPtc'
  );

INSERT INTO
  "events" (
    "id",
    "title",
    "description",
    "time",
    "location",
    "host_organization",
    "image_file",
    "image_ext",
    "image_citation"
  )
VALUES
  (
    7,
    'Outdoor Movie Screening',
    'Watch a classic film under the stars! Bring blankets and snacks. Free popcorn provided.',
    'Friday, February 28, 2025 at 8:00 PM',
    'Slope Day Field',
    'Cornell Cinema',
    'cc-outdoor-movie-screening.jpg',
    'jpg',
    'https://unsplash.com/photos/two-people-sitting-on-a-blanket-watching-a-movie-Uff2iGkpNs4'
  );

INSERT INTO
  "events" (
    "id",
    "title",
    "description",
    "time",
    "location",
    "host_organization",
    "image_file",
    "image_ext",
    "image_citation"
  )
VALUES
  (
    8,
    'Mental Health Workshop',
    'Learn stress management techniques and self-care strategies. Small group discussion format.',
    'Tuesday, March 4, 2025 at 3:00 PM',
    'Cornell Health Center',
    'Cornell Health',
    'ch-mental-health-workshop.jpg',
    'jpg',
    'https://unsplash.com/photos/people-sitting-on-chair-inside-room-vnAa6Ra34A4'
  );

INSERT INTO
  "events" (
    "id",
    "title",
    "description",
    "time",
    "location",
    "host_organization",
    "image_file",
    "image_ext",
    "image_citation"
  )
VALUES
  (
    9,
    'International Food Festival',
    'Sample cuisines from around the world prepared by student cultural organizations. Ticket sales benefit scholarship fund.',
    'Saturday, March 8, 2025 at 12:00 PM',
    'Barton Hall',
    'International Students Union',
    'isu-international-food-festival.jpg',
    'jpg',
    'https://unsplash.com/photos/people-line-up-at-a-japanese-food-stall-7c524C8mN7g'
  );

INSERT INTO
  "events" (
    "id",
    "title",
    "description",
    "time",
    "location",
    "host_organization",
    "image_file",
    "image_ext",
    "image_citation"
  )
VALUES
  (
    10,
    'Coding Bootcamp Kickoff',
    'Introduction to web development. Laptops required. Limited spots available - RSVP required.',
    'Wednesday, March 12, 2025 at 6:00 PM',
    'Gates Hall, Room 114',
    'Cornell Tech Club',
    'ctc-coding-bootcamp-kickoff.jpg',
    'jpg',
    'https://unsplash.com/photos/monitor-showing-java-programming-OqtafYT5kTw'
  );

CREATE TABLE "tags" (
  id INTEGER NOT NULL UNIQUE,
  name TEXT NOT NULL UNIQUE,
  PRIMARY KEY(id AUTOINCREMENT)
);

INSERT INTO
  "tags" ("id", "name")
VALUES
  (1, 'free');

INSERT INTO
  "tags" ("id", "name")
VALUES
  (2, 'paid');

INSERT INTO
  "tags" ("id", "name")
VALUES
  (3, 'social');

INSERT INTO
  "tags" ("id", "name")
VALUES
  (4, 'educational');

INSERT INTO
  "tags" ("id", "name")
VALUES
  (5, 'open-event');

INSERT INTO
  "tags" ("id", "name")
VALUES
  (6, 'private');

INSERT INTO
  "tags" ("id", "name")
VALUES
  (7, 'weekend');

INSERT INTO
  "tags" ("id", "name")
VALUES
  (8, 'food');

INSERT INTO
  "tags" ("id", "name")
VALUES
  (9, 'arts');

INSERT INTO
  "tags" ("id", "name")
VALUES
  (10, 'networking');

CREATE TABLE "event_tags" (
  id INTEGER NOT NULL UNIQUE,
  event_id INTEGER NOT NULL,
  tag_id INTEGER NOT NULL,
  PRIMARY KEY(id AUTOINCREMENT),
  FOREIGN KEY(event_id) REFERENCES events(id),
  FOREIGN KEY(tag_id) REFERENCES tags(id)
);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (1, 1, 1);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (2, 1, 3);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (3, 1, 5);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (4, 1, 8);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (5, 1, 7);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (6, 2, 1);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (7, 2, 5);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (8, 2, 9);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (9, 3, 1);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (10, 3, 3);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (11, 3, 8);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (12, 3, 7);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (13, 4, 1);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (14, 4, 4);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (15, 5, 1);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (16, 5, 3);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (17, 5, 5);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (18, 6, 1);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (19, 6, 10);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (20, 6, 6);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (21, 7, 1);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (22, 7, 5);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (23, 7, 7);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (24, 8, 1);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (25, 8, 4);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (26, 9, 2);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (27, 9, 3);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (28, 9, 8);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (29, 9, 7);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (30, 10, 1);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (31, 10, 4);

INSERT INTO
  "event_tags" ("id", "event_id", "tag_id")
VALUES
  (32, 10, 6);
