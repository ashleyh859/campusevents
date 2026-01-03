# Campus Events Catalog

For my INFO 2300 Intermediate Web Design & Programming final project, I designed and developed a full-stack web application to help new Cornell students discover campus events and enable student organization leaders to manage event postings effectively.

Cornell transfer students and freshmen often feel disconnected from campus life and struggle to discover what student organizations and events exist. Meanwhile, student organization leaders need an efficient way to promote their events and reach potential attendees. This platform addresses both needs through a dual-interface system with a consumer-facing discovery platform and a secure administrative portal.

## Access the Site

You can access the live site at https://campus-event.page.gd/ or run it locally by opening a GitHub Codespace and starting the development server. 

To access admin features, use username `ashley.huang` and password `monkey`.

## User Goals

**For Students:**
1. Discover what student organizations and events exist on campus
2. Find events that match their interests, schedule, and budget
3. Feel less isolated by connecting with campus communities

**For Event Organizers:**
1. Post and promote their organization's events to reach attendees
2. Keep event information accurate by editing and removing events
3. Organize events with tags to help students discover them

I employed a user-centered design process, developing personas to guide decisions. The consumer interface uses a mobile-optimized card grid with sidebar filtering, while the admin interface uses a desktop-optimized tile layout with inline actions. Built with HTML5, CSS3, PHP, and SQL with secure session management, password hashing, and protection against SQL injection and XSS attacks. WAVE-compliant and W3C validated.

## Features

- **Browse Events:** View all campus events in a card-based layout optimized for mobile
- **Filter by Category:** Click on tags to filter events by type
- **Event Details:** View comprehensive information about each event on a dedicated page
- **Admin Portal:** Secure administrative interface for managing events, uploading images, and organizing tags
- **User Access Controls:** Password-protected admin features with login/logout functionality
