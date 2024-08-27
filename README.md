# Query craft sites

Get basic information about craft sites in graphql.

## Install
```
composer require "dunkel/graphqlsites:^0.1.4" -w && php craft plugin/install _craft-graphql-sites
```

```gql
query {
  # csites for craft sites, because craft might wan't to use sites in the future
  csites {
    id
    baseUrl
    language
    name
    handle
    enabled
    hasUrls
    primary
    sortOrder
    group {
      id
      name
    }
  }
}
```
