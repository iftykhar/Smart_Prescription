 
 ## PRESCRIPTION Management System 
 
 ## Backend API 
 - Laravel
 - MVC pattern
 - OOP PHP

## API Documentation Endpoint
## Create a Doctor Profile 
POST Method `https://example.com/api/doctor/create`

 * Here endpoint is `/doctor/create`

Example: 

Endpoint: POST Method `/doctor/create`

this method accepts some object and every object are required
 - name (required)
 - email (required, must be valid email address)
 - phone (required, must be 11 digit)
 - degree (required)
 - address (required)
 - hospital_id (optional, next update will be required)


Show all Doctor List
GET Method `/doctor`


Show a Doctor by id
GET Method `/doctor/id`


Show a Doctor by id
GET Method `/doctor/id`


Update a Doctor Profile
PUT OR PATCH Method `/doctor/id`


Delete Doctor Profile
Delete Method `/doctor/id`

---
Prescription
---


