
/**
* First we will load all of this project's JavaScript dependencies which
* includes Vue and other libraries. It is a great starting point when
* building robust, powerful web applications using Vue and Laravel.
*/
window.Vue = require('vue');

import VueResource from "vue-resource";
Vue.use(VueResource);

import VeeValidate from 'vee-validate';
const dictionary = {
  en: {
    messages:{
      alpha: (field, args) => 'The field "' + field + '" must be characters only',
      min: (field,args) => 'The field "' + field + '" must be at least '+ args +' characters',
      numeric: (field,args) => 'The field "' + field + '" must be numbers only',
      email: (field,args) => 'The field "' + field + '" must be a valid email address',
    }
  },
  es: {
    messages: {
      alpha: (field, args) => 'El campo "' + field + '" solo admite letras',
      min: (field,args) => 'El campo "' + field + '" debe tener al menos '+ args +' caracteres',
      numeric: (field,args) => 'El campo "' + field + '" solo admite números',
      email: (field,args) => 'El campo "' + field + '" debe contener una dirección de correo electrónico válida',
      date_between: () => 'La fecha debe ser menor a la fecha actual'
    }
  },
};
Validator.updateDictionary(dictionary);
const config = {
  errorBagName: 'errors', // change if property conflicts
  fieldsBagName: 'fields',
  delay: 0,
  locale: 'es',
  dictionary: null,
  strict: true,
  classes: false,
  classNames: {
    touched: 'touched', // the control has been blurred
    untouched: 'untouched', // the control hasn't been blurred
    valid: 'form-success', // model is valid
    invalid: 'form-danger', // model is invalid
    pristine: 'pristine', // control has not been interacted with
    dirty: 'dirty' // control has been interacted with
  },
  events: 'input|blur',
  inject: true,
  validity: false,
  aria: true
};

Vue.use(VeeValidate, config);

import { Validator } from 'vee-validate';

const validator = new Validator({
  first_name: 'required|alpha',
  last_name: 'required',
  birth_date: 'required',
  identity: 'numeric',
  phone: 'required|numeric',
  cellphone: 'numeric',
  email: 'email'
});

Vue.component('alert', {
  template: '<transition name="fade"><p v-if="this.checkIfShow()" class="rounded p-3 text-light mb-3 [messageType == ´1´ ? bg-danger : bg-success]"><button @click="closeAlert()" type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{message}}</p></transition>',
  props: ['message', 'messageType'],
  data: function () {
    return {
      hidden: false
    }
  },
  methods: {
    checkIfShow() {
      return !this.hidden && this.message != '';
    },
    showMessage() {
      return this.message ? true : false
    },
    closeAlert() {
      this.hidden = true;
    }
  }
});

const familia = new Vue({
  el: '#familia', // Elemento
  data: {
    addingMember: {
      first_name: {
        value: '',
        type: String,
        required: true
      },
      last_name: {
        value: '',
        type: String,
        required: true,
      },
      birth_date: {
        value: '',
        required: true,
      },
      identity: {
        value: '',
        type: Number
      },
      phone: {
        value: '',
        type: Number
      },
      cellphone: {
        value: '',
        type: Number
      },
      email: {
        validator: function (value) {
          return value.match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/');
        },
        value: ''
      },
      isFamilyMain: false,
      isAdult: ''
    },
    parentMessage: '',
    parentMessageType: '0',
    //Toggles para cambiar entre ventanas
    toggle: {
      create: false,
      edit: false,
      delete: false,
      checkEdit: false,
      checkDelete: false
    },
    deletedFamilies:[],
    //Lista de miembros a guardar/editar
    members:[],
    formSubmitted: false,
    hasMain: false,
    apartment: '',
    exists: false,
    newFamily: false,
    editFamily: false,
    family_id: '',
    payments_list: {
      apartment: '',
      date: '',
      list: []
    },
  },
  methods: {
    //Metodo para comprobar si el propietario ya está en la lista
    ownerexists: function() {
      if(this.addingMember.identity.value.length > 5) {
        this.$http.get('/checkIfOwnerExists/'+this.addingMember.identity.value)
        .then(function(response) {
          if(response.body.notFoundError) {
            console.log('no existe en DB');
          }
          else {

          }
        })
        .catch(function(response) {

        });
      }


      if(this.members.length > 0) {
        for (var index in this.members) {
          if(this.identity == this.members[index]) {
            this.exists = true;
            console.log('Existe en Lista');
          }
          else {
            console.log('No existe en lista');
          }
        }
      }
    },
    //Metodo para restablecer el formulario de propietario luego
    //de agregarlo a la lista
    resetForm: function() {
      this.addingMember.first_name.value = '';
      this.addingMember.last_name.value = '';
      this.addingMember.birth_date.value = '';
      this.addingMember.identity.value = '';
      this.addingMember.phone.value = '';
      this.addingMember.cellphone.value = '';
      this.addingMember.email.value = '';
    },
    //Metodo para saber la edad del propietario
    checkAge: function() {
      var olddate = this.addingMember.birth_date.value.split("/");
      var birthDateString = olddate[1] + "/" + olddate[0] + "/" + olddate[2];
      var birthday = new Date(birthDateString);
      var ageDifMs = Date.now() - birthday.getTime();
      var ageDate = new Date(ageDifMs); // miliseconds from epoch
      console.log(Math.abs(ageDate.getFullYear() - 1970));
      return Math.abs(ageDate.getFullYear() - 1970);
    },
    //Metodo para comprobar si el propietario es mayor de edad y
    //solicitar los datos adicionales
    isMemberAdult: function() {
      this.checkAge() > 18 ? this.addingMember.isAdult = true : this.addingMember.isAdult = false;
    },
    //Metodo para comprobar si el propietario es el representante
    //de la familia
    isRepr: function() {
      if(this.hasMain) {
        return true;
      }
      return false;
    },
    //Metodo para agregar una persona a la familia.
    //·Si es adulto, se exigirá nombre, apellido, fecha de nacimiento, cedula y telefono fijo,
    //ademas de que se permitira marcar como representante de la familia, siempre y cuando no exista uno
    //·Si no es adulto, solo se exigirá nombre, apellido y fecha de nacimiento
    isOwnerFormValid: function() {
      if(!this.isMemberAdult()) {
        return this.addingMember.first_name.value != "" && this.addingMember.last_name.value != "" && this.addingMember.birth_date.value != '';
      }
      else {
        return this.addingMember.first_name.value != "" && this.addingMember.last_name.value != "" && this.addingMember.birth_date.value != '' && this.addingMember.identity.value != '';
      }
    },
    //Metodo para comprobar si el formulario de la lista de propietarios
    //esta correctamente llenado con representante y apartamento asignado
    isFamilyFormValid: function() {
      return this.hasMain && this.apartment != '';
    },
    //Metodo para procesar el formulario de agregar propietario
    submitForm: function() {
      if(!this.isOwnerFormValid()) return;
      this.formSubmitted = true;
      this.addMember();
      this.adult = false;
    },
    //Metodo para agregar un propietario a la lista
    addMember: function() {
      this.members.push({
        first_name:this.addingMember.first_name.value,
        last_name:this.addingMember.last_name.value,
        birth_date:this.addingMember.birth_date.value,
        identity: this.addingMember.identity.value,
        phone: this.addingMember.phone.value,
        cellphone: this.addingMember.cellphone.value,
        email:this.addingMember.email.value,
        main:this.addingMember.isFamilyMain
      });
      if(this.addingMember.isFamilyMain) {
        this.hasMain = true;
        this.addingMember.isFamilyMain = false;
      }
      this.resetForm();
    },
    //Metodo para almacenar la familia en la base de datos
    guardarFamilia: function(e) {
      e.preventDefault();
      this.$http.post('/guardarFamilia', {
        members: this.members,
        apartment: this.apartment,
      })
      .then(function(response) {
        if(response.body.success)
        {
          this.parentMessage = 'Familia guardada correctamente';
          this.parentMessageType = '2';
          this.newFamily = false;
          this.goToMainPage();
        }
        else {
          this.parentMessage = "Ha ocurrido un error";
          this.parentMessageType = '1';
        }
      })
      .catch(function(response) {
        console.log(response.body.error);
        this.parentMessage = "Ha ocurrido un error";
        this.parentMessageType = '1';
      });
    },
    //Metodo para almacenar la familia editada en la base de datos
    editarFamilia: function(e) {
      e.preventDefault();
      this.$http.post('/editarFamilia', {
        members: this.members,
        apartment: this.apartment,
        family_id: this.family_id
      })
      .then(function(response) {
        if(response.body.success)
        {
          this.parentMessage = 'Familia guardada correctamente';
          this.parentMessageType = '2';
          this.newFamily = false;
          this.goToMainPage();
        }
        else {
          this.parentMessage = "Ha ocurrido un error";
          this.parentMessageType = '1';
        }
      })
      .catch(function(response) {
        console.log(response);
        this.parentMessage = "Ha ocurrido un error";
        this.parentMessageType = '2';
      });
    },
    //Metodo para comprobar si el menu Principal debe ser mostrado
    isMainMenu: function() {
      return !this.toggle.create && !this.toggle.edit && !this.toggle.delete;
    },
    //Metodo para comprobar si el menu de Crear debe ser mostrado
    isCreateMenu: function() {
      return this.toggle.create;
    },
    //Metodo para comprobar si el menu de Crear o Editar estan activos
    isCreateEditMode: function() {
      return this.toggle.create || this.toggle.edit;
    },
    //Metodo para comprobar si el boton de editar/eliminar esta activado
    toggled: function() {
      return this.toggle.checkEdit || this.toggle.checkDelete;
    },
    //Metodo para mostrar la opcion de editar
    toggleEdit: function() {
      if(this.toggle.checkEdit)
      {this.toggle.checkEdit = false;}
      else
      {this.toggle.checkEdit = true;}

      this.toggle.checkDelete = false;
    },
    //Metodo para mostrar el menu de Editar
    toggleEditMode: function(familyId) {
      this.toggleEdit();
      this.toggle.edit = true;
      this.family_id = familyId;

      this.$http.post('/getFamilyMembers', {
        id: familyId
      })
      .then(function(response) {
        this.formSubmitted = true;
        this.members = response.body.owners;
        this.apartment = response.body.apartment.toString();
        console.log(this.apartment);
        for (var i = 0; i < this.members.length; i++) {
          if(this.members[i].main == "1")
            this.hasMain = true;
        }
      })
      .catch(function(response) {
        this.parentMessage = "Ha ocurrido un error";
        this.parentMessageType = '2';
      });

    },
    //Metodo para mostrar la opcion de eliminar
    toggleDelete: function() {
      if(this.toggle.checkDelete)
      {this.toggle.checkDelete = false;}
      else
      {this.toggle.checkDelete = true;}

      this.toggle.checkEdit = false;
    },
    //Metodo para separar una familia del apartamento
    eliminarFamilia: function(family_id) {
      this.toggleDelete();
      this.$http.post('/deshabitar', {
        family_id: family_id
      })
      .then(function(response) {
        this.alert.successMessage = 'Familia eliminada correctamente';
        this.alert.successDisplay = true;
        this.newFamily = false;
        this.deletedFamilies.push(family_id);
        //this.deleted.push(apartment);
        this.toggleDelete();
      })
      /*.catch(function(response) {
      this.alert.errorMessage = 'Error al eliminar';
      this.alert.errorDisplay = true;
    })*/;
  },
  //Metodo para eliminar el miembro de la familia de la lista de edicion
  deleteEditingMember: function(identity) {
    for(var index in this.members) {
      if(this.members[index].main) {
        console.log("Es main");
        this.hasMain = false;
      }

      if(this.members[index].identity === identity) {
        console.log('Está');
        this.members.splice(index, 1);
      }
    }
  },
  //Metodo para comprobar si el miembro de la familia fue eliminado o no
  checkFamilyDeleted: function(family_id) {
    for (var i in this.deletedFamilies) {
      if(this.deletedFamilies[i] == family_id) {
        return true;
      }
    }
    return false;
  },
  //Metodo que oculta el formulario de nueva familia
  goToMainPage: function() {
    this.toggle.create = false;
    this.toggle.edit = false;
    this.members = [];
    this.resetForm();
  },


  //Metodos para Condominio
  getPaymentsData: function(ap_id) {
    console.log(ap_id);
    this.$http.get('/getPaymentsData', {
      apartment: ap_id
    })
    .then(function(response) {
      console.log(response.body.payments);
      //this.payments_list = response.body.payments;
    })
    .catch(function(response) {
      console.log(response.body.error);
    });
  },
}
});

const condominio = new Vue ({
  el: '#condominio',
  data: {
    parentMessage: '',
    parentMessageType: '0',
    payments: {
      payment_date: '',
      payment_method: '',
      paid_month: ''
    },
    toPayApartment: '',
    payment: {
      apartment: {
        floor: '',
        side: ''
      },
      months: {
        value: 1,
        price: 9000,
        type: Number
      },
      paymentType: '',
      bankNumber: '',
      originBank: ''
    },
    payments_list: [],
    toggle: {
      newPayment: false
    },
    pagination: {
      currentPage: 1
    },
    apartment: {
      name: '',
      identity: '',
      isRent: false,
      lastMonthPaid: ''
    },
    config: {
      older_debtor: {
        value: 0
      }
    }
  },
  created() {
    //do something after creating vue instance
    this.$http.get('/getOlderDebtor', {
    })
    .then(function(response) {
      this.config.older_debtor.value = response.body.older_debtor;
    })
  },
  methods: {
    getApartmentData: function() {
      this.$http.get('/getApartmentData/'+this.payment.apartment.floor+'-'+this.payment.apartment.side, {
        apartment: this.payment.apartment.floor+'-'+this.payment.apartment.side
      })
      .then(function(response) {

        console.log(response.body);
        this.apartment = response.body;
      })
      .catch(function(response) {
        if(response.body.error1) {
          this.parentMessage = 'El apartamento seleccionado está deshabitado';
          this.parentMessageType = '2';
        }
      })
    },
    nextPage: function() {
      this.pagination.currentPage++
    },
    checkApartmentSelected: function() {
      if(this.payment.apartment.floor != '' && this.payment.apartment.side != '') return true
    },
    getPaymentsData: function(apartment) {
      this.$http.post('/getPaymentsData', {
        apartment: apartment
      })
      .then(function(response) {
        this.payments_list = response.body.payments;
      })
      .catch(function(response) {
        console.log(response.body.error);
      });
    },
    addMonth: function() {
      if(this.payment.months.value > 0 && this.payment.months.value < 12)
      this.payment.months.value++;
    },
    substractMonth: function() {
      if(this.payment.months.value > 1 && this.payment.months.value <= 12)
      this.payment.months.value--;
    },
    updatePaymentMethod: function() {
      console.log('asdasd');
      this.payment.originBank = '';
      this.payment.bankNumber = '';
    },
    savePayment: function() {
      console.log('Guardando pago...');
    },
    getPaymentType: function() {
      switch (this.payment.paymentType) {
        case '1':
        return 'Efectivo';
        break;
        case '2':
        return 'Depósito';
        break;
        case '3':
        return 'Transferencia';
        break;
        case '4':
        return 'Cheque';
        break;
        default:
        return 'Error';
      }
    },
    getOriginBank: function() {
      switch (this.payment.originBank) {
        case '1':
        return 'Banco Provincial'
        break;
      }
    }
  }
});

const settings = new Vue({
  el: '#settings',
  data: {
    config: {
      older_debtor: {
        value: undefined
      }
    },
    message: '',
    messageType: '',
    successClass: 'bg-success',
    errorClass: 'bg-danger'
  },
  created() {
    this.$http.get('/getOlderDebtor', {
    })
    .then(function(response) {
      this.config.older_debtor.value = response.body.older_debtor;
    })
  },
  methods: {
    storeOlderDebtor: function() {
      this.$http.post('/storeOlderDebtor', {
        older_debtor: this.config.older_debtor.value
      })
      .then(function(response) {
        this.message = 'El ultimo año de deudas se ha establecido en '+this.config.older_debtor.value;
        this.messageType = 1;
      })
      .catch(function(response) {
        console.log(response.body.error);
        this.message = 'Ha ocurrido un error';
      })
    }
  }
});
