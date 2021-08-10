<template>
  <div>
    <template>
      <b-tabs pills>
        <!-- Tab: Account -->
        <b-tab active>
          <template #title>
            <feather-icon icon="HeartIcon" size="16" class="mr-0 mr-sm-50" />
            <span class="d-none d-sm-inline">Sonuçlar</span>
          </template>
          <results />
        </b-tab>

        <!-- Tab: Information -->
        <b-tab>
          <template #title>
            <feather-icon icon="UsersIcon" size="16" class="mr-0 mr-sm-50" />
            <span class="d-none d-sm-inline">Kullanıcılar</span>
          </template>
          <users />
        </b-tab>
        <b-tab>
          <template #title>
            <feather-icon
              icon="BriefcaseIcon"
              size="16"
              class="mr-0 mr-sm-50"
            />
            <span class="d-none d-sm-inline">Kurumsal Müşteriler</span>
          </template>
          <clients />
        </b-tab>

        <b-tab>
          <template #title>
            <feather-icon
              icon="BriefcaseIcon"
              size="16"
              class="mr-0 mr-sm-50"
            />
            <span class="d-none d-sm-inline">Bireysel Müşteriler</span>
          </template>
          <individual />
        </b-tab>

        <b-tab>
          <template #title>
            <feather-icon
              icon="ClipboardIcon"
              size="16"
              class="mr-0 mr-sm-50"
            />
            <span class="d-none d-sm-inline">Kursiyerler</span>
          </template>
          <kursiyer />
        </b-tab>
      </b-tabs>
    </template>
  </div>
</template>

<script>
import users from "./users/users.vue";
import clients from "./clients/clients";
import results from "./results/lab.vue";
import individual from "./individual/individual.vue";
import kursiyer from "./kursiyer/liste.vue";

export default {
  components: {
    users,
    clients,
    results,
    individual,
    kursiyer,
  },
};
</script>

<style>
</style>
