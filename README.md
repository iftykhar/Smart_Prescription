 
 ## Prescription Management System 
 
 ### Backend API Made with
 - Laravel
 - MVC pattern
 - OOP PHP

### API Documentation Endpoint
#### Create a Doctor Profile 

 - Example`https://example.com/api/doctor/create`

 * Here endpoint is `/doctor/create`

#### Let's start: 

Endpoint: `/doctor/create`  - POST 

This method accepts some object and every object are required
 - name (required)
 - email (required, must be valid email address)
 - phone (required, must be 11 digit)
 - degree (required)
 - address (required)
 - hospital_id (optional, next update will be required)

Response like this: 
```
{ 
    "stats": true, 
    "message": "Create Success" 
}
```


#### Show all Doctor List
Endpoint `/doctor` - GET


#### Show a Doctor by id
Endpoint `/doctor/id` - GET


#### Update a Doctor Profile
 Endpoint `/doctor/id` - PUT OR PATCH


#### Delete Doctor Profile
Endpoint `/doctor/id` -DELETE
