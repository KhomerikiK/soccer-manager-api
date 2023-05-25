# Fantasy Football API

This API provides endpoints for both user authentication and fantasy football management.

# API Features

## Localization

The API supports multiple languages and is built with localization in mind. In order to request resources in a particular language, include the `X-App-Locale` header in your request with the desired language code (e.g., 'en' for English, 'ka' for Georgian).

## Laravel Nova for Admin Functionalities

For administrative purposes, this API also includes Laravel Nova integration. Laravel Nova is a beautiful administration panel for Laravel that provides a robust set of tools for managing the application's resources.

## API Endpoints

### Authentication Endpoints

- **Registration (`POST /register`)**
    - Controller: `RegisteredUserController@store`
    - Accessibility: Guest users

- **Login (`POST /login`)**
    - Controller: `AuthenticatedSessionController@store`
    - Accessibility: Guest users

- **Forgot Password (`POST /forgot-password`)**
    - Controller: `PasswordResetLinkController@store`
    - Accessibility: Guest users

- **Reset Password (`POST /reset-password`)**
    - Controller: `NewPasswordController@store`
    - Accessibility: Guest users

- **Verify Email (`GET /verify-email/{id}/{hash}`)**
    - Controller: `VerifyEmailController`
    - Accessibility: Authenticated users

- **Resend Verification Email (`POST /email/verification-notification`)**
    - Controller: `EmailVerificationNotificationController@store`
    - Accessibility: Authenticated users

- **Logout (`POST /logout`)**
    - Controller: `AuthenticatedSessionController@destroy`
    - Accessibility: Authenticated users

### Football manager endpoints

- **Get User (`GET /user`)**
    - Description: Fetches the details of the currently authenticated user.

- **Get Team (`GET /v1/team`)**
    - Controller: `GetTeamController`
    - Description: Fetches the details of the authenticated user's team.

- **Update Team (`PATCH /v1/team`)**
    - Controller: `UpdateTeamController`
    - Description: Updates the details of the authenticated user's team.

- **Get Team Players (`GET /v1/team/players`)**
    - Controller: `GetTeamPlayersController`
    - Description: Fetches all the players of the authenticated user's team.

- **Get Team Player (`GET /v1/team/players/{id}`)**
    - Controller: `GetTeamPlayerController`
    - Description: Fetches the details of a specific player (identified by `{id}`) of the authenticated user's team.

- **Update Team Player (`PATCH /v1/team/players/{id}`)**
    - Controller: `UpdateTeamPlayerController`
    - Description: Updates the details of a specific player (identified by `{id}`) of the authenticated user's team.

- **List Team Player (`POST /v1/team/players/{id}/list`)**
    - Controller: `ListTeamPlayerOnMarketController`
    - Description: Lists a specific player (identified by `{id}`) of the authenticated user's team on the market.

- **Get Market Data (`GET /v1/market-data`)**
    - Controller: `GetMarketDataController`
    - Description: Fetches all the players currently listed on the market.

- **Buy Listed Player (`POST /v1/market-data/{listingId}/buy`)**
    - Controller: `BuyListedPlayerController`
    - Description: Purchases a specific player (identified by `{listingId}`) from the market.
