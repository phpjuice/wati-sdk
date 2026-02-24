# Changelog

All notable changes to `phpjuice/wati-sdk` will be documented in this file.

## 1.0.1

- Add `ResponseData` base class with `hasMore()` and `isSuccessful()` methods
- Refactor response data classes to extend `ResponseData`
- Add unit tests for `ResponseData`

## 1.0.0

- Initial release of Wati SDK
- Pre-built API classes for Wati API:
  - `Wati\Api\GetContacts` - Get paginated list of contacts
- PHP 8.3+ support
- Add Laravel service provider
