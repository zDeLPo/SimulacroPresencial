# SQL Manager 2005 for MySQL 3.6.5.1
# ---------------------------------------
# Host     : 192.168.0.199
# Port     : 3306
# Database : simulacropre20151


SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE `simulacropre20151`
    CHARACTER SET 'latin1'
    COLLATE 'latin1_swedish_ci';

#
# Structure for the `agencia` table : 
#

CREATE TABLE `agencia` (
  `age_iCodigo` int(11) NOT NULL,
  `age_vcNombre` varchar(100) DEFAULT NULL,
  `dep_vcCodigo` varchar(2) DEFAULT NULL,
  `pro_vcCodigo` varchar(2) DEFAULT NULL,
  `dis_vcCodigo` varchar(2) DEFAULT NULL,
  `age_vcDireccion` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`age_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Structure for the `area` table : 
#

CREATE TABLE `area` (
  `are_cCodigo` char(1) NOT NULL,
  `are_vcNombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`are_cCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `tipoprueba` table : 
#

CREATE TABLE `tipoprueba` (
  `tippru_iCodigo` int(11) NOT NULL,
  `tippru_vcNombre` varchar(25) NOT NULL,
  PRIMARY KEY (`tippru_iCodigo`),
  UNIQUE KEY `tippru_vcNombre` (`tippru_vcNombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `sede` table : 
#

CREATE TABLE `sede` (
  `sed_iCodigo` int(11) NOT NULL AUTO_INCREMENT,
  `sed_vcNombre` varchar(20) DEFAULT NULL,
  `sed_cDepartamentoTodos` char(1) NOT NULL DEFAULT 'S',
  `sed_cHabilitado` char(1) DEFAULT 'S',
  PRIMARY KEY (`sed_iCodigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 4096 kB';

#
# Structure for the `zona` table : 
#

CREATE TABLE `zona` (
  `sed_iCodigo` int(10) NOT NULL,
  `zon_iCodigo` int(10) NOT NULL,
  `zon_vcNombre` varchar(50) DEFAULT NULL,
  `zon_dFechaPrueba` date DEFAULT '2014-08-17',
  `zon_vcDiaPrueba` varchar(10) DEFAULT 'DOMINGO',
  `tippru_iCodigo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`sed_iCodigo`,`zon_iCodigo`),
  KEY `sed_iCodigo` (`sed_iCodigo`),
  KEY `tippru_iCodigo` (`tippru_iCodigo`),
  CONSTRAINT `fk_zona_tipoprueba` FOREIGN KEY (`tippru_iCodigo`) REFERENCES `tipoprueba` (`tippru_iCodigo`),
  CONSTRAINT `zona_fk` FOREIGN KEY (`sed_iCodigo`) REFERENCES `sede` (`sed_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `locales` table : 
#

CREATE TABLE `locales` (
  `sed_iCodigo` int(10) NOT NULL,
  `zon_iCodigo` int(10) NOT NULL,
  `loc_iCodigo` int(10) NOT NULL,
  `loc_iAulas` int(10) DEFAULT '0',
  `loc_vcNombre` varchar(100) DEFAULT NULL,
  `loc_vcNombreCorto` varchar(50) DEFAULT NULL,
  `tippru_iCodigo` int(11) DEFAULT '1',
  `loc_vcCodigoUnidad` varchar(6) NOT NULL,
  `loc_cInvidente` char(1) NOT NULL DEFAULT 'N',
  `loc_vcPuerta` varchar(30) DEFAULT NULL,
  `loc_vcDireccion` varchar(80) DEFAULT 'Ciudad Universitaria - UNMSM Av. Venezuela cdra. 34 S/N',
  PRIMARY KEY (`sed_iCodigo`,`zon_iCodigo`,`loc_iCodigo`),
  KEY `sed_iCodigo` (`sed_iCodigo`,`zon_iCodigo`),
  KEY `locales_fk1` (`tippru_iCodigo`),
  CONSTRAINT `locales_fk` FOREIGN KEY (`sed_iCodigo`, `zon_iCodigo`) REFERENCES `zona` (`sed_iCodigo`, `zon_iCodigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `locales_fk1` FOREIGN KEY (`tippru_iCodigo`) REFERENCES `tipoprueba` (`tippru_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `aula` table : 
#

CREATE TABLE `aula` (
  `aul_iCodigo` int(10) NOT NULL,
  `sed_iCodigo` int(10) NOT NULL,
  `zon_iCodigo` int(10) NOT NULL,
  `loc_iCodigo` int(10) NOT NULL,
  `aul_iCapacidad` int(10) DEFAULT '25',
  `aul_iAsignados` int(10) DEFAULT '0',
  PRIMARY KEY (`aul_iCodigo`),
  KEY `sed_iCodigo` (`sed_iCodigo`,`zon_iCodigo`,`loc_iCodigo`),
  CONSTRAINT `aula_fk` FOREIGN KEY (`sed_iCodigo`, `zon_iCodigo`, `loc_iCodigo`) REFERENCES `locales` (`sed_iCodigo`, `zon_iCodigo`, `loc_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `banco` table : 
#

CREATE TABLE `banco` (
  `ban_iCodigo` int(11) NOT NULL AUTO_INCREMENT,
  `ban_vcNombre` varchar(50) DEFAULT NULL,
  `ban_cActivo` char(1) DEFAULT NULL,
  PRIMARY KEY (`ban_iCodigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Structure for the `procesoadmision` table : 
#

CREATE TABLE `procesoadmision` (
  `proadm_vcCodigo` varchar(25) NOT NULL,
  `proadm_vcNombre` varchar(50) DEFAULT NULL,
  `proadm_cActivo` char(20) DEFAULT NULL,
  PRIMARY KEY (`proadm_vcCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `calificacion` table : 
#

CREATE TABLE `calificacion` (
  `ide_iAnonimo` int(11) NOT NULL,
  `cal_iBuenAptitud` int(11) DEFAULT NULL,
  `cal_iMalAptitud` int(11) DEFAULT NULL,
  `cal_iBuenConocimiento` int(11) DEFAULT NULL,
  `cal_iMalConocimiento` int(11) DEFAULT NULL,
  `cal_fPuntajeConocimiento` decimal(10,3) DEFAULT NULL,
  `cal_fPuntajeAptitud` decimal(10,3) DEFAULT NULL,
  `cal_fNotaFinal` decimal(10,3) DEFAULT NULL,
  `mod_iCondicionIngreso` int(11) DEFAULT NULL,
  `cal_iEapMerito` int(11) DEFAULT NULL,
  `cal_iMeritoGeneral` int(11) DEFAULT NULL,
  `tippru_iCodigo` int(11) DEFAULT NULL,
  `zon_dFechaPrueba` date DEFAULT NULL,
  `cod_vcCodigo` varchar(6) NOT NULL,
  `mod_cModalidadIngreso` char(1) DEFAULT NULL,
  `fasing_iCodigo` int(4) DEFAULT NULL,
  `proadm_vcCodigo` varchar(25) DEFAULT NULL,
  `cal_cAnuladoCovertura` char(1) DEFAULT 'N',
  `cal_iNulAptitud` int(11) DEFAULT NULL,
  `cal_iNulConocimiento` int(11) DEFAULT NULL,
  `cal_cAnulado` char(1) DEFAULT 'N',
  `cal_vcMotivoAnulado` varchar(300) DEFAULT NULL,
  `pos_fNotaAptitudFisica` float(9,3) DEFAULT '0.000',
  PRIMARY KEY (`cod_vcCodigo`),
  KEY `ide_iAnonimo` (`ide_iAnonimo`),
  KEY `FK_calificacion_1` (`proadm_vcCodigo`),
  CONSTRAINT `FK_calificacion_1` FOREIGN KEY (`proadm_vcCodigo`) REFERENCES `procesoadmision` (`proadm_vcCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `catalogo` table : 
#

CREATE TABLE `catalogo` (
  `tabla_nombre` varchar(128) NOT NULL,
  `tabla_descripcion` text,
  PRIMARY KEY (`tabla_nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `cepusmciclo` table : 
#

CREATE TABLE `cepusmciclo` (
  `cepcic_iCodigo` int(11) NOT NULL AUTO_INCREMENT,
  `cepcic_vcNombre` varchar(50) DEFAULT NULL,
  `cepcic_cHabilitado` char(1) DEFAULT 'S',
  PRIMARY KEY (`cepcic_iCodigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Structure for the `cepusmingresante` table : 
#

CREATE TABLE `cepusmingresante` (
  `ceping_vcCodigo` varchar(6) NOT NULL,
  `ceping_vcNombre` varchar(50) DEFAULT NULL,
  `esc_vcCodigo` varchar(5) DEFAULT NULL,
  `ceping_fPuntaje` float(13,5) DEFAULT NULL,
  `ceping_iMerito` int(2) DEFAULT NULL,
  `cepcic_iCodigo` int(11) DEFAULT NULL,
  `poscodmat_vcCodigo` varchar(8) DEFAULT NULL,
  `ceping_cAnulado` char(1) DEFAULT 'N',
  `cod_vcCodigo` varchar(6) DEFAULT NULL,
  `mod_cCodigo` char(1) DEFAULT NULL,
  `poscodmat_vcProceso` varchar(25) DEFAULT '2007-II',
  `poscodmat_vcResolucionRectoral` varchar(50) DEFAULT '01280-R-07',
  `fasing_iCodigo` int(8) DEFAULT NULL,
  `ceping_cAnuladoCovertura` char(1) DEFAULT 'N',
  UNIQUE KEY `IDX_cepusmingresante_1` (`poscodmat_vcCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 214016 kB\r\n\r\nDebemos cambiar el nombre a la tab';

#
# Structure for the `cepusmoperacion` table : 
#

CREATE TABLE `cepusmoperacion` (
  `ceping_iCodigo` int(11) NOT NULL AUTO_INCREMENT,
  `ope_vcNumero` varchar(10) DEFAULT NULL,
  `pro_vcCodigo` varchar(8) DEFAULT NULL,
  `cod_vcCodigo` varchar(6) DEFAULT NULL,
  `ceping_dSistema` datetime DEFAULT NULL,
  PRIMARY KEY (`ceping_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `clave` table : 
#

CREATE TABLE `clave` (
  `cla_iCodigo` int(11) NOT NULL,
  `cla_vcRespuesta` varchar(120) DEFAULT NULL,
  `cla_iAnonimo` int(11) DEFAULT NULL,
  `tippru_iCodigo` int(11) NOT NULL DEFAULT '0',
  `zon_dFechaPrueba` date NOT NULL DEFAULT '2013-08-18',
  PRIMARY KEY (`cla_iCodigo`,`tippru_iCodigo`,`zon_dFechaPrueba`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `grupo` table : 
#

CREATE TABLE `grupo` (
  `gru_iCodigo` int(11) NOT NULL DEFAULT '0',
  `gru_liMinimo` bigint(20) NOT NULL DEFAULT '0',
  `gru_liMaximo` bigint(20) NOT NULL DEFAULT '0',
  `gru_iUltimo` int(11) NOT NULL DEFAULT '0',
  `gru_iCuenta` int(11) NOT NULL DEFAULT '0',
  `gru_iNoInscrito` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`gru_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `codigo` table : 
#

CREATE TABLE `codigo` (
  `gru_iCodigo` int(11) NOT NULL DEFAULT '0',
  `cod_iNumero` int(11) NOT NULL DEFAULT '0',
  `cod_vcCodigo` varchar(6) NOT NULL,
  `cod_cUsado` char(1) NOT NULL DEFAULT 'N',
  `cod_cAnulado` char(1) NOT NULL,
  PRIMARY KEY (`cod_vcCodigo`),
  KEY `fk_grupo` (`gru_iCodigo`),
  CONSTRAINT `codigo_ibfk_1` FOREIGN KEY (`gru_iCodigo`) REFERENCES `grupo` (`gru_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `escuela` table : 
#

CREATE TABLE `escuela` (
  `esc_vcCodigo` varchar(5) NOT NULL,
  `esc_vcNombre` varchar(50) NOT NULL,
  `are_cCodigo` char(1) NOT NULL,
  `gru_iCodigo` int(11) NOT NULL,
  `esc_cActivo` char(1) DEFAULT 'S',
  PRIMARY KEY (`esc_vcCodigo`),
  KEY `fk_area` (`are_cCodigo`),
  KEY `FK_escuela_2` (`gru_iCodigo`),
  CONSTRAINT `escuela_fk` FOREIGN KEY (`are_cCodigo`) REFERENCES `area` (`are_cCodigo`),
  CONSTRAINT `FK_escuela_2` FOREIGN KEY (`gru_iCodigo`) REFERENCES `grupo` (`gru_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `codigoaula` table : 
#

CREATE TABLE `codigoaula` (
  `codaul_iAula` int(11) NOT NULL,
  `cod_vcCodigo` varchar(6) NOT NULL,
  `aul_iCodigo` int(11) DEFAULT NULL,
  `pos_vcPaterno` varchar(50) NOT NULL,
  `pos_vcMaterno` varchar(50) NOT NULL,
  `pos_vcNombre` varchar(50) NOT NULL,
  `esc_vcCodigo` varchar(5) DEFAULT NULL,
  `codaul_cImpreso` char(1) DEFAULT 'N',
  KEY `FK_codigoaula_codigo` (`cod_vcCodigo`),
  KEY `FK_codigoaula_aula` (`aul_iCodigo`),
  KEY `IXFK_codigoaula` (`esc_vcCodigo`),
  CONSTRAINT `FK_codigoaula_aula` FOREIGN KEY (`aul_iCodigo`) REFERENCES `aula` (`aul_iCodigo`),
  CONSTRAINT `FK_codigoaula_codigo` FOREIGN KEY (`cod_vcCodigo`) REFERENCES `codigo` (`cod_vcCodigo`),
  CONSTRAINT `FK_codigoaula_escuela` FOREIGN KEY (`esc_vcCodigo`) REFERENCES `escuela` (`esc_vcCodigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `formainscripcion` table : 
#

CREATE TABLE `formainscripcion` (
  `forins_iCodigo` int(11) NOT NULL AUTO_INCREMENT,
  `forins_vcNombre` varchar(50) NOT NULL,
  `forins_fFactor` float(9,3) NOT NULL DEFAULT '100.000',
  `forins_cEscuelaTodo` char(1) NOT NULL DEFAULT 'S',
  `forins_cModalidadTodo` char(1) NOT NULL DEFAULT 'S',
  `forins_cPagoCarpeta` char(1) NOT NULL DEFAULT 'N',
  `forins_liMinimo` bigint(20) NOT NULL DEFAULT '0',
  `forins_liMaximo` bigint(20) NOT NULL DEFAULT '0',
  `forins_iUltimo` int(11) NOT NULL DEFAULT '0',
  `forins_iCuenta` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`forins_iCodigo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

#
# Structure for the `codigoexonerado` table : 
#

CREATE TABLE `codigoexonerado` (
  `codexo_vcCodigo` varchar(10) NOT NULL,
  `forins_iCodigo` int(11) NOT NULL,
  `codexo_iCodigo` int(11) NOT NULL,
  PRIMARY KEY (`codexo_vcCodigo`),
  KEY `codigoexonerado_fk` (`forins_iCodigo`),
  CONSTRAINT `codigoexonerado_fk` FOREIGN KEY (`forins_iCodigo`) REFERENCES `formainscripcion` (`forins_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `tipoinstitucion` table : 
#

CREATE TABLE `tipoinstitucion` (
  `tipins_iCodigo` int(11) NOT NULL,
  `tipins_vcNombre` varchar(25) NOT NULL,
  PRIMARY KEY (`tipins_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `colegio` table : 
#

CREATE TABLE `colegio` (
  `col_iCodigo` int(11) NOT NULL AUTO_INCREMENT,
  `col_vcCodigo` varchar(7) NOT NULL,
  `col_vcNombre` varchar(50) DEFAULT NULL,
  `col_vcDireccion` varchar(50) DEFAULT NULL,
  `col_vcNivel` varchar(50) DEFAULT NULL,
  `col_vcDepartamento` varchar(50) DEFAULT NULL,
  `col_vcProvincia` varchar(50) DEFAULT NULL,
  `col_vcDistrito` varchar(50) DEFAULT NULL,
  `tipins_iCodigo` int(11) NOT NULL,
  PRIMARY KEY (`col_iCodigo`),
  KEY `fk_tipoInstitucion` (`tipins_iCodigo`),
  CONSTRAINT `FK_tipoinstitucion` FOREIGN KEY (`tipins_iCodigo`) REFERENCES `tipoinstitucion` (`tipins_iCodigo`)
) ENGINE=InnoDB AUTO_INCREMENT=21416 DEFAULT CHARSET=latin1;

#
# Structure for the `tipouniversidad` table : 
#

CREATE TABLE `tipouniversidad` (
  `tipuni_iCodigo` int(11) NOT NULL,
  `tipuni_vcNombre` varchar(25) NOT NULL,
  PRIMARY KEY (`tipuni_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `departamento` table : 
#

CREATE TABLE `departamento` (
  `dep_vcCodigo` varchar(2) NOT NULL,
  `dep_vcNombre` varchar(50) NOT NULL,
  `dep_cValidaCronograma` char(1) NOT NULL DEFAULT 'S',
  `dep_vcPrefijoTelefonico` varchar(3) DEFAULT NULL,
  `dep_iLongitudFijo` int(11) DEFAULT NULL,
  `dep_iLongitudCelular` int(11) DEFAULT NULL,
  PRIMARY KEY (`dep_vcCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `pais` table : 
#

CREATE TABLE `pais` (
  `pai_vcCodigo` varchar(6) NOT NULL,
  `pai_vcNombre` char(50) NOT NULL,
  `pai_vcCou` char(50) DEFAULT NULL,
  PRIMARY KEY (`pai_vcCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `universidad` table : 
#

CREATE TABLE `universidad` (
  `uni_vcCodigo` varchar(12) NOT NULL,
  `uni_vcNombre` varchar(75) DEFAULT NULL,
  `uni_vcweb` varchar(75) DEFAULT NULL,
  `pai_vcCodigo` varchar(6) DEFAULT NULL,
  `dep_vcCodigo` varchar(2) DEFAULT NULL,
  `uni_sede` varchar(50) DEFAULT NULL,
  `tipins_iCodigo` int(11) NOT NULL,
  `tipuni_iCodigo` int(11) NOT NULL,
  PRIMARY KEY (`uni_vcCodigo`),
  KEY `fk_pais` (`pai_vcCodigo`),
  KEY `fk_tipoInstitucion` (`tipins_iCodigo`),
  KEY `fk_tipouniversidad` (`tipuni_iCodigo`),
  KEY `fk_departamento` (`dep_vcCodigo`),
  CONSTRAINT `fk_tipouniversidad` FOREIGN KEY (`tipuni_iCodigo`) REFERENCES `tipouniversidad` (`tipuni_iCodigo`),
  CONSTRAINT `universidad_fk` FOREIGN KEY (`dep_vcCodigo`) REFERENCES `departamento` (`dep_vcCodigo`),
  CONSTRAINT `universidad_ibfk_1` FOREIGN KEY (`pai_vcCodigo`) REFERENCES `pais` (`pai_vcCodigo`),
  CONSTRAINT `universidad_ibfk_2` FOREIGN KEY (`tipins_iCodigo`) REFERENCES `tipoinstitucion` (`tipins_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `prospecto` table : 
#

CREATE TABLE `prospecto` (
  `pro_vcCodigo` varchar(8) NOT NULL,
  `pro_cUsado` char(1) NOT NULL DEFAULT 'N',
  `pro_cAnulado` char(1) NOT NULL DEFAULT 'N',
  `pro_cEntregado` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`pro_vcCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `provincia` table : 
#

CREATE TABLE `provincia` (
  `dep_vcCodigo` varchar(2) NOT NULL,
  `pro_vcCodigo` varchar(2) NOT NULL,
  `pro_vcNombre` varchar(50) NOT NULL,
  PRIMARY KEY (`dep_vcCodigo`,`pro_vcCodigo`),
  KEY `dep_vcCodigo` (`dep_vcCodigo`),
  CONSTRAINT `provincia_fk` FOREIGN KEY (`dep_vcCodigo`) REFERENCES `departamento` (`dep_vcCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `distrito` table : 
#

CREATE TABLE `distrito` (
  `dep_vcCodigo` varchar(2) NOT NULL,
  `pro_vcCodigo` varchar(2) NOT NULL,
  `dis_vcCodigo` varchar(2) NOT NULL,
  `dis_vcNombre` varchar(50) NOT NULL,
  `dis_vcUbigeo` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`dep_vcCodigo`,`pro_vcCodigo`,`dis_vcCodigo`),
  CONSTRAINT `distrito_ibfk_1` FOREIGN KEY (`dep_vcCodigo`, `pro_vcCodigo`) REFERENCES `provincia` (`dep_vcCodigo`, `pro_vcCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `modalidad` table : 
#

CREATE TABLE `modalidad` (
  `mod_cCodigo` char(1) NOT NULL,
  `mod_vcNombre` varchar(50) NOT NULL,
  `mod_cCodigoCompetidor` char(1) DEFAULT NULL,
  `mod_iCondicionIngreso` int(4) DEFAULT NULL,
  `mod_cActivo` char(1) NOT NULL DEFAULT 'S',
  `mod_cSuperNumerario` varchar(1) NOT NULL DEFAULT 'N',
  `tippru_iCodigo` int(11) NOT NULL COMMENT 'G es examen general, E es examen especial',
  `mod_vcAbreviatura` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`mod_cCodigo`),
  KEY `fk_modalidad` (`mod_cCodigoCompetidor`),
  KEY `modalidad_fk` (`tippru_iCodigo`),
  CONSTRAINT `modalidad_fk` FOREIGN KEY (`tippru_iCodigo`) REFERENCES `tipoprueba` (`tippru_iCodigo`),
  CONSTRAINT `modalidad_ibfk_1` FOREIGN KEY (`mod_cCodigoCompetidor`) REFERENCES `modalidad` (`mod_cCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `universidadescuela` table : 
#

CREATE TABLE `universidadescuela` (
  `uni_vcCodigo` varchar(12) NOT NULL,
  `uniesc_iCodigo` int(11) NOT NULL AUTO_INCREMENT,
  `uniesc_vcNombre` varchar(75) NOT NULL,
  `esc_vcCodigo` varchar(5) NOT NULL,
  PRIMARY KEY (`uniesc_iCodigo`),
  KEY `fk_escuela` (`esc_vcCodigo`),
  KEY `fk_universidad` (`uni_vcCodigo`),
  CONSTRAINT `universidadescuela_ibfk_1` FOREIGN KEY (`esc_vcCodigo`) REFERENCES `escuela` (`esc_vcCodigo`),
  CONSTRAINT `universidadescuela_ibfk_2` FOREIGN KEY (`uni_vcCodigo`) REFERENCES `universidad` (`uni_vcCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `postulante` table : 
#

CREATE TABLE `postulante` (
  `cod_vcCodigo` varchar(6) NOT NULL,
  `pro_vcCodigo` varchar(8) NOT NULL,
  `pos_fMonto` float(7,2) NOT NULL DEFAULT '0.00',
  `forins_iCodigo` int(11) NOT NULL DEFAULT '0',
  `esc_vcCodigo` varchar(5) NOT NULL,
  `esc_vcCodigoOrigen` varchar(5) DEFAULT NULL,
  `mod_cCodigo` char(1) NOT NULL,
  `pos_vcPaterno` varchar(50) NOT NULL,
  `pos_vcMaterno` varchar(50) NOT NULL,
  `pos_vcNombre` varchar(50) NOT NULL,
  `col_iCodigo` int(11) DEFAULT NULL,
  `pos_cSexo` char(1) NOT NULL DEFAULT 'M',
  `pos_vcPrefijoTelefono` varchar(3) DEFAULT NULL,
  `pos_vcTelefono` varchar(11) DEFAULT NULL,
  `pos_vcPrefijoCelular` varchar(3) DEFAULT NULL,
  `pos_vcTelefonoCelular` varchar(9) DEFAULT NULL,
  `pos_vcEmail` varchar(75) DEFAULT NULL,
  `pos_dNacimiento` date NOT NULL,
  `pos_vcDireccion` varchar(80) NOT NULL,
  `pos_cDiscapacitado` char(1) DEFAULT NULL,
  `pos_vcConadis` varchar(10) DEFAULT NULL,
  `pos_vcDiscapacidad` varchar(30) DEFAULT NULL,
  `pos_vcTutor` varchar(50) DEFAULT NULL,
  `pos_vcTelefonoTutor` varchar(12) DEFAULT NULL,
  `pos_iVecesPostulo` int(11) NOT NULL DEFAULT '0',
  `medinf_iCodigo` int(11) NOT NULL DEFAULT '0',
  `pos_cInvidente` char(1) NOT NULL,
  `pos_dFechaInscripcion` date NOT NULL,
  `pos_tHorainscripcion` time NOT NULL,
  `pos_vcIp` varchar(30) DEFAULT NULL,
  `uni_vcCodigo` varchar(12) DEFAULT NULL,
  `sed_iCodigo` int(11) NOT NULL,
  `dep_vcCodigoResidencia` varchar(2) DEFAULT NULL,
  `pro_vcCodigoResidencia` varchar(2) DEFAULT NULL,
  `dis_vcCodigoResidencia` varchar(6) DEFAULT NULL,
  `tippre_iCodigo` int(11) NOT NULL,
  `tipdoc_iCodigo` int(11) NOT NULL,
  `pos_vcDocumento` varchar(25) NOT NULL,
  `pai_vcCodigo` varchar(6) DEFAULT NULL,
  `pos_cAnulado` char(1) DEFAULT 'N',
  `dep_vcCodigoNacimiento` varchar(2) NOT NULL,
  `pos_dUltimaMatricula` int(11) DEFAULT NULL,
  `pos_iCreditosAcumulados` int(11) DEFAULT '0',
  `pos_iGradoObtenido` int(11) DEFAULT NULL,
  `pos_iApoderado` int(11) DEFAULT NULL,
  `pos_iAnioEgreso` int(11) DEFAULT NULL,
  `pos_vcDocumentoModalidad` varchar(50) DEFAULT NULL COMMENT 'Incluye:\r\nConvenio, Comunidad Nativa, Heroes de Guerra y victimas de terrorismo, documento olimpico',
  `pos_vcLenguaNativa` varchar(50) DEFAULT NULL,
  `pos_iOrdenMerito` int(11) DEFAULT NULL,
  `pos_iParentesco` int(11) DEFAULT NULL,
  `pos_iFederacion` int(11) DEFAULT NULL,
  `pos_iCicloCepusm` int(11) DEFAULT NULL,
  `uniesc_iCodigo` int(11) DEFAULT NULL,
  `pos_escuela_grado` varchar(50) DEFAULT NULL,
  `proadm_vcCodigo` varchar(25) DEFAULT NULL,
  `pos_cInvidenteOriginal` char(20) DEFAULT NULL,
  `pos_fNotaAptitudFisica` float(9,3) DEFAULT NULL,
  PRIMARY KEY (`cod_vcCodigo`),
  KEY `fk_distrito` (`dep_vcCodigoResidencia`,`pro_vcCodigoResidencia`,`dis_vcCodigoResidencia`),
  KEY `fk_pais` (`pai_vcCodigo`),
  KEY `fk_modalidad` (`mod_cCodigo`),
  KEY `fk_escuela` (`esc_vcCodigo`),
  KEY `fk_prospecto` (`pro_vcCodigo`),
  KEY `fk_universidadescuela` (`uniesc_iCodigo`),
  KEY `fk_colegio` (`col_iCodigo`),
  KEY `postulante_fk` (`uni_vcCodigo`),
  KEY `postulante_fk1` (`sed_iCodigo`),
  KEY `dep_vcCodigoNacimiento` (`dep_vcCodigoNacimiento`),
  KEY `forins_iCodigo` (`forins_iCodigo`),
  KEY `esc_vcCodigoDestino` (`esc_vcCodigoOrigen`),
  KEY `ix_Nombre` (`pos_vcPaterno`,`pos_vcMaterno`,`pos_vcNombre`),
  KEY `FK_postulanteproceso_1` (`proadm_vcCodigo`),
  CONSTRAINT `fk_colegio` FOREIGN KEY (`col_iCodigo`) REFERENCES `colegio` (`col_iCodigo`),
  CONSTRAINT `FK_postulanteproceso_1` FOREIGN KEY (`proadm_vcCodigo`) REFERENCES `procesoadmision` (`proadm_vcCodigo`),
  CONSTRAINT `postulante_fk` FOREIGN KEY (`uni_vcCodigo`) REFERENCES `universidad` (`uni_vcCodigo`),
  CONSTRAINT `postulante_fk1` FOREIGN KEY (`sed_iCodigo`) REFERENCES `sede` (`sed_iCodigo`),
  CONSTRAINT `postulante_fk2` FOREIGN KEY (`dep_vcCodigoNacimiento`) REFERENCES `departamento` (`dep_vcCodigo`),
  CONSTRAINT `postulante_fk3` FOREIGN KEY (`forins_iCodigo`) REFERENCES `formainscripcion` (`forins_iCodigo`),
  CONSTRAINT `postulante_fk4` FOREIGN KEY (`esc_vcCodigoOrigen`) REFERENCES `escuela` (`esc_vcCodigo`),
  CONSTRAINT `postulante_fk5` FOREIGN KEY (`pro_vcCodigo`) REFERENCES `prospecto` (`pro_vcCodigo`),
  CONSTRAINT `postulante_ibfk_1` FOREIGN KEY (`cod_vcCodigo`) REFERENCES `codigo` (`cod_vcCodigo`),
  CONSTRAINT `postulante_ibfk_2` FOREIGN KEY (`dep_vcCodigoResidencia`, `pro_vcCodigoResidencia`, `dis_vcCodigoResidencia`) REFERENCES `distrito` (`dep_vcCodigo`, `pro_vcCodigo`, `dis_vcCodigo`),
  CONSTRAINT `postulante_ibfk_3` FOREIGN KEY (`pai_vcCodigo`) REFERENCES `pais` (`pai_vcCodigo`),
  CONSTRAINT `postulante_ibfk_6` FOREIGN KEY (`mod_cCodigo`) REFERENCES `modalidad` (`mod_cCodigo`),
  CONSTRAINT `postulante_ibfk_7` FOREIGN KEY (`esc_vcCodigo`) REFERENCES `escuela` (`esc_vcCodigo`),
  CONSTRAINT `postulante_ibfk_9` FOREIGN KEY (`uniesc_iCodigo`) REFERENCES `universidadescuela` (`uniesc_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `codigofisica` table : 
#

CREATE TABLE `codigofisica` (
  `codfis_iNumero` int(4) DEFAULT NULL,
  `codfis_vcInscripcion` varchar(3) NOT NULL,
  `codfis_vcNombre` varchar(75) NOT NULL,
  `codfis_vcCodigo` varchar(9) NOT NULL,
  `codfis_cSexo` char(1) DEFAULT NULL,
  `codfis_cApto` char(1) NOT NULL,
  `cod_vcCodigo` varchar(6) DEFAULT NULL,
  `cod_vcCodigo2` varchar(6) DEFAULT NULL,
  KEY `IXFK_codigofisica` (`cod_vcCodigo`),
  CONSTRAINT `FK_codigofisica_1` FOREIGN KEY (`cod_vcCodigo`) REFERENCES `postulante` (`cod_vcCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `concepto` table : 
#

CREATE TABLE `concepto` (
  `con_vcCodigo` varchar(6) NOT NULL DEFAULT '000',
  `con_vcNombre` varchar(100) NOT NULL DEFAULT '-- NA --',
  `con_fMonto` float(7,2) NOT NULL DEFAULT '0.00',
  `con_cValidoInscripcion` char(1) DEFAULT 'S',
  `con_cProspecto` char(1) DEFAULT 'S',
  `tipins_iCodigo` int(11) DEFAULT NULL,
  PRIMARY KEY (`con_vcCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `conceptovarios` table : 
#

CREATE TABLE `conceptovarios` (
  `con_vcCodigo` varchar(6) DEFAULT NULL,
  `con_fMonto` float(7,2) DEFAULT NULL,
  `con_vcCodigoHijo` varchar(6) DEFAULT NULL,
  `con_fMontoHijo` float(7,2) DEFAULT NULL,
  KEY `IXFK_conceptovarios` (`con_vcCodigo`),
  CONSTRAINT `FK_conceptovarios_1` FOREIGN KEY (`con_vcCodigo`) REFERENCES `concepto` (`con_vcCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `constancia` table : 
#

CREATE TABLE `constancia` (
  `con_iCodigo` bigint(20) NOT NULL AUTO_INCREMENT,
  `cod_vcCodigo` varchar(6) NOT NULL,
  `congru_iCodigo` bigint(20) DEFAULT NULL,
  `con_dFechaImpresion` datetime DEFAULT NULL,
  `con_cImpresion` char(1) DEFAULT 'N',
  `con_vcOperador` varchar(50) DEFAULT NULL,
  `poscodmat_vcCodigo` varchar(20) DEFAULT NULL,
  `con_vcPathFoto` varchar(150) DEFAULT NULL,
  `con_vcPathHuella` varchar(150) DEFAULT NULL,
  `con_vcPathFirma` varchar(150) DEFAULT NULL,
  `con_cAnulado` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`con_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `constanciagrupo` table : 
#

CREATE TABLE `constanciagrupo` (
  `congru_iCodigo` bigint(20) NOT NULL AUTO_INCREMENT,
  `congru_dtFecha` datetime DEFAULT NULL,
  `congru_vcUsuario` varchar(50) DEFAULT NULL,
  `congru_cActivo` char(1) DEFAULT 'N',
  PRIMARY KEY (`congru_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `consulta` table : 
#

CREATE TABLE `consulta` (
  `con_iCodigo` int(11) NOT NULL AUTO_INCREMENT,
  `con_vcTitulo` varchar(150) DEFAULT NULL,
  `con_vcDescripcion` varchar(250) DEFAULT NULL,
  `con_txtQuery` text,
  `con_cActivo` char(1) DEFAULT NULL,
  PRIMARY KEY (`con_iCodigo`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

#
# Structure for the `cronograma` table : 
#

CREATE TABLE `cronograma` (
  `cro_cLetra` char(1) NOT NULL,
  `cro_dInicioRegular` date DEFAULT NULL,
  `cro_dFinRegular` date DEFAULT NULL,
  `cro_dInicioRezagado` date DEFAULT NULL,
  `cro_dFinRezagado` date DEFAULT NULL,
  PRIMARY KEY (`cro_cLetra`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `cronogramaconstancia` table : 
#

CREATE TABLE `cronogramaconstancia` (
  `crocon_iCodigo` int(2) NOT NULL AUTO_INCREMENT,
  `crocon_dFecha` date NOT NULL,
  `esc_vcCodigo` varchar(20) NOT NULL,
  `crocon_vcDia` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`crocon_iCodigo`),
  UNIQUE KEY `esc_vcCodigo` (`esc_vcCodigo`,`crocon_dFecha`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

#
# Structure for the `dominio` table : 
#

CREATE TABLE `dominio` (
  `dom_vcCodigo` varchar(12) NOT NULL,
  `dom_vcNombre` char(50) NOT NULL,
  PRIMARY KEY (`dom_vcCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `dominiodetalle` table : 
#

CREATE TABLE `dominiodetalle` (
  `dom_vcCodigo` varchar(12) NOT NULL,
  `domdet_iCodigo` int(11) NOT NULL,
  `domdet_vcNombre` char(50) NOT NULL,
  `domdet_cHabilitado` char(1) NOT NULL,
  PRIMARY KEY (`dom_vcCodigo`,`domdet_iCodigo`),
  CONSTRAINT `dominiodetalle_ibfk_1` FOREIGN KEY (`dom_vcCodigo`) REFERENCES `dominio` (`dom_vcCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `educacionfisica` table : 
#

CREATE TABLE `educacionfisica` (
  `cod_vcCodigo` varchar(6) NOT NULL,
  `NOMBRE` varchar(60) NOT NULL,
  `PUNTAJE_ACADEMICO` float(12,4) DEFAULT NULL,
  `PUNTAJE_FISICO` float(12,4) DEFAULT NULL,
  `PUNTAJE_TOTAL` float(12,4) DEFAULT NULL,
  `MERITO` int(11) DEFAULT NULL,
  `OBSERVACION` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`cod_vcCodigo`),
  UNIQUE KEY `cod_vcCodigo` (`cod_vcCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `encuesta` table : 
#

CREATE TABLE `encuesta` (
  `cod_vcCodigo` varchar(6) NOT NULL,
  `enc_dtRegistro` datetime DEFAULT NULL,
  `enc_iConQuienVive` int(11) DEFAULT NULL,
  `enc_vcConQuienViveOtro` varchar(50) DEFAULT NULL,
  `enc_iMiembrosHogar` int(11) DEFAULT NULL,
  `enc_iHabitacionDormitorio` int(11) DEFAULT NULL,
  `enc_cHogarServicioDomestico` char(1) DEFAULT NULL,
  `enc_cHogarTelefonoFijo` char(1) DEFAULT NULL,
  `enc_cHogarCable` char(1) DEFAULT NULL,
  `enc_cHogarComputadora` char(1) DEFAULT NULL,
  `enc_cHogarInternet` char(1) DEFAULT NULL,
  `enc_iLugarAlimentos` int(11) DEFAULT NULL,
  `enc_vcLugarAlimentosOtros` varchar(50) DEFAULT NULL,
  `enc_iGradoPadre` int(11) DEFAULT NULL,
  `enc_iGradoMadre` int(11) DEFAULT NULL,
  `enc_iOcupacionPadre` int(11) DEFAULT NULL,
  `enc_iOcupacionMadre` int(11) DEFAULT NULL,
  `enc_fPromedioSecundaria` float(13,5) DEFAULT NULL,
  `enc_iGastoEstudios` int(11) DEFAULT NULL,
  `enc_vcGastoEstudiosOtros` varchar(50) DEFAULT NULL,
  `enc_iPorqueCarrera` int(11) DEFAULT NULL,
  `enc_iPorqueSanMarcos` int(11) DEFAULT NULL,
  `enc_vcPorqueSanMarcosOtro` varchar(50) DEFAULT NULL,
  `enc_iFormacionAcademica` int(11) DEFAULT NULL,
  `enc_vcFormacionAcademicaOtro` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `encuesta2` table : 
#

CREATE TABLE `encuesta2` (
  `cod_vcCodigo` varchar(6) NOT NULL,
  `enc_dtRegistro` datetime NOT NULL,
  `enc_vcDistritoResidencia` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `enc_iConQuienVive` int(11) DEFAULT NULL,
  `enc_vcConQuienViveOtro` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `enc_iMantieneHogar` int(11) DEFAULT NULL,
  `enc_vcMantieneHogarOtro` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `enc_iNumeroVecesUNMSM` int(11) DEFAULT NULL,
  `enc_iNumeroVecesOtra` int(11) DEFAULT NULL,
  `enc_iTipoPreparacion` int(11) DEFAULT NULL,
  `enc_vcTipoPreparacionOtro` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `enc_iMotivoUNMSM` int(11) DEFAULT NULL,
  `enc_vcMotivoUNMSMOtro` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `enc_iMotivoCarrera` int(11) DEFAULT NULL,
  `enc_vcMotivoCarreraOtro` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `enc_iMotivoUniversitario` int(11) DEFAULT NULL,
  `enc_vcMotivoUniversitarioOtro` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `enc_iAccesoInternet` int(11) DEFAULT NULL,
  `enc_iUsaEmail` int(11) DEFAULT NULL,
  `enc_iDedicaEstudio` int(11) DEFAULT NULL,
  `enc_iFormaEstudio` int(11) DEFAULT NULL,
  `enc_iTrabaja` int(11) DEFAULT NULL,
  `enc_fIngresoMensual` float(13,5) DEFAULT NULL,
  `enc_iHorasLabor` int(11) DEFAULT NULL,
  `enc_iApoyoPadre` int(11) DEFAULT NULL,
  `enc_iApoyoMadre` int(11) DEFAULT NULL,
  `enc_iTiempoApoyo` int(11) DEFAULT NULL,
  `enc_vcTiempoApoyoOtro` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `enc_iTipoApoyoPre` int(11) DEFAULT NULL,
  `enc_iTipoVivienda` int(11) DEFAULT NULL,
  `enc_vcTipoViviendaOtro` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `enc_iSituacionVivienda` int(11) DEFAULT NULL,
  `enc_vcSituacionViviendaOtro` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `enc_iNroDormitorios` int(11) DEFAULT NULL,
  `enc_iNroBanios` int(11) DEFAULT NULL,
  `enc_iTipoMaterial` int(11) DEFAULT NULL,
  `enc_vcTipoMaterialOtro` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `enc_vcBienesEnseres` varchar(17) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `enc_vcServicios` varchar(4) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  KEY `cod_vcCodigo` (`cod_vcCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `encuestaexamen` table : 
#

CREATE TABLE `encuestaexamen` (
  `ide_iAnonimo` int(11) NOT NULL,
  `cod_vcCodigo` varchar(6) NOT NULL,
  `enc_vcRespuesta` varchar(40) NOT NULL,
  `ide_iLectora` int(11) DEFAULT NULL,
  `ide_iPosicionLectura` int(11) DEFAULT NULL,
  `aul_iCodigo` int(11) DEFAULT NULL,
  `tippru_iCodigo` int(11) DEFAULT '1',
  `zon_dFechaPrueba` date DEFAULT '2013-08-18',
  PRIMARY KEY (`ide_iAnonimo`),
  KEY `identificacion_FKIndex1` (`cod_vcCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `faseingreso` table : 
#

CREATE TABLE `faseingreso` (
  `fasing_iCodigo` int(4) NOT NULL DEFAULT '0',
  `fasing_vcDescripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`fasing_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `fechaprueba` table : 
#

CREATE TABLE `fechaprueba` (
  `fecprue_dFecha` date NOT NULL,
  `fecprue_vcDia` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`fecprue_dFecha`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Structure for the `ficha` table : 
#

CREATE TABLE `ficha` (
  `cod_vcCodigo` varchar(6) NOT NULL,
  `fic_iNivelInformatica` smallint(6) DEFAULT NULL,
  `fic_iOtraUniversidad` smallint(6) DEFAULT NULL,
  `fic_iIngresoMensualFamiliar` smallint(6) DEFAULT NULL,
  `fic_iSituacionFamiliar` smallint(6) DEFAULT NULL,
  `fic_iCondicionFamiliar` smallint(6) DEFAULT NULL,
  `fic_iNumeroDependientes` smallint(6) DEFAULT NULL,
  `fic_iSituacionSaludFamilia` smallint(6) DEFAULT NULL,
  `fic_iSituacionSaludIngresante` smallint(6) DEFAULT NULL,
  `fic_iAtencionSaludFamilia` smallint(6) DEFAULT NULL,
  `fic_iIngresoPostulante` smallint(6) DEFAULT NULL,
  `fic_iPagoColegio` smallint(6) DEFAULT NULL,
  `fic_iPagoPreUniversitaria` smallint(6) DEFAULT NULL,
  `fic_iPropiedadVivienda` smallint(6) DEFAULT NULL,
  `fic_iUbicacionVivienda` smallint(6) DEFAULT NULL,
  `fic_iMaterialVivienda` smallint(6) DEFAULT NULL,
  `fic_iServiciosVivienda` smallint(6) DEFAULT NULL,
  `fic_iArtefactos` smallint(6) DEFAULT NULL,
  `fic_tRegistroFicha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fic_cImpreso` char(1) DEFAULT 'N',
  `fic_tsFechaImpresion` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fic_dtActualizado` datetime DEFAULT NULL,
  PRIMARY KEY (`cod_vcCodigo`),
  CONSTRAINT `FK_ficha_1` FOREIGN KEY (`cod_vcCodigo`) REFERENCES `postulante` (`cod_vcCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `formainscripciondetalle` table : 
#

CREATE TABLE `formainscripciondetalle` (
  `forins_iCodigo` int(11) NOT NULL,
  `forinsdet_iGeneracion` int(11) NOT NULL,
  `forinsdet_dtFecha` datetime NOT NULL,
  `forinsdet_iCantidad` int(11) NOT NULL,
  PRIMARY KEY (`forins_iCodigo`,`forinsdet_iGeneracion`),
  CONSTRAINT `FK_formainscripciondetalle_1` FOREIGN KEY (`forins_iCodigo`) REFERENCES `formainscripcion` (`forins_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `formainscripcionescuela` table : 
#

CREATE TABLE `formainscripcionescuela` (
  `forins_iCodigo` int(11) NOT NULL,
  `esc_vcCodigo` varchar(5) NOT NULL,
  PRIMARY KEY (`forins_iCodigo`,`esc_vcCodigo`),
  KEY `fk_escuela` (`esc_vcCodigo`),
  CONSTRAINT `formainscripcionescuela_ibfk_1` FOREIGN KEY (`esc_vcCodigo`) REFERENCES `escuela` (`esc_vcCodigo`),
  CONSTRAINT `formainscripcionescuela_ibfk_2` FOREIGN KEY (`forins_iCodigo`) REFERENCES `formainscripcion` (`forins_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `formainscripcionmodalidad` table : 
#

CREATE TABLE `formainscripcionmodalidad` (
  `forins_iCodigo` int(11) NOT NULL,
  `mod_cCodigo` char(1) NOT NULL,
  PRIMARY KEY (`forins_iCodigo`,`mod_cCodigo`),
  KEY `fk_modalidad` (`mod_cCodigo`),
  CONSTRAINT `formainscripcionmodalidad_ibfk_1` FOREIGN KEY (`mod_cCodigo`) REFERENCES `modalidad` (`mod_cCodigo`),
  CONSTRAINT `formainscripcionmodalidad_ibfk_2` FOREIGN KEY (`forins_iCodigo`) REFERENCES `formainscripcion` (`forins_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `grupodetalle` table : 
#

CREATE TABLE `grupodetalle` (
  `gru_iCodigo` int(11) NOT NULL,
  `grudet_iGeneracion` int(10) unsigned NOT NULL,
  `grudet_dtFecha` datetime NOT NULL,
  `grudet_iCantidad` int(10) unsigned NOT NULL,
  PRIMARY KEY (`gru_iCodigo`,`grudet_iGeneracion`),
  CONSTRAINT `FK_grupodetalle_1` FOREIGN KEY (`gru_iCodigo`) REFERENCES `grupo` (`gru_iCodigo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `grupotipoprueba` table : 
#

CREATE TABLE `grupotipoprueba` (
  `gru_iCodigo` int(11) NOT NULL,
  `tippru_iCodigo` int(11) NOT NULL,
  `fecpru_dFecha` date NOT NULL,
  PRIMARY KEY (`gru_iCodigo`,`tippru_iCodigo`),
  KEY `gru_iCodigo` (`gru_iCodigo`),
  KEY `tippru_iCodigo` (`tippru_iCodigo`),
  KEY `fecpru_dFecha` (`fecpru_dFecha`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `identificacion` table : 
#

CREATE TABLE `identificacion` (
  `ide_iAnonimo` int(11) NOT NULL,
  `cod_vcCodigo` varchar(6) NOT NULL,
  `ide_iLectora` int(11) DEFAULT NULL,
  `ide_iPosicionLectura` int(11) DEFAULT NULL,
  `aul_iCodigo` int(11) DEFAULT NULL,
  `tippru_iCodigo` int(11) DEFAULT '1',
  `zon_dFechaPrueba` date DEFAULT '2014-08-17',
  PRIMARY KEY (`ide_iAnonimo`),
  KEY `identificacion_FKIndex1` (`cod_vcCodigo`),
  CONSTRAINT `identificacion_ibfk_1` FOREIGN KEY (`cod_vcCodigo`) REFERENCES `postulante` (`cod_vcCodigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `modalidadcondicioningreso` table : 
#

CREATE TABLE `modalidadcondicioningreso` (
  `mod_cModalidadIngreso` char(1) NOT NULL DEFAULT '',
  `fasing_iCodigo` int(4) NOT NULL DEFAULT '0',
  KEY `IXFK_modalidadcondicioningreso` (`fasing_iCodigo`),
  CONSTRAINT `FK_modalidadcondicioningreso_1` FOREIGN KEY (`fasing_iCodigo`) REFERENCES `faseingreso` (`fasing_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `ocurrencia` table : 
#

CREATE TABLE `ocurrencia` (
  `ocu_iCodigo` int(11) NOT NULL AUTO_INCREMENT,
  `ocu_vcActa` varchar(12) DEFAULT NULL,
  `ocu_dtFecha` datetime DEFAULT NULL,
  `ocu_vcTabla` varchar(50) NOT NULL,
  `ocu_vcCampo` varchar(50) NOT NULL,
  `ocu_vcLlave` varchar(50) DEFAULT NULL,
  `ocu_vcAnterior` varchar(75) DEFAULT NULL,
  `ocu_vcNuevo` varchar(75) DEFAULT NULL,
  `ocu_vcSolicita` varchar(50) DEFAULT NULL,
  `ocu_vcMotivo` text,
  `ocu_vcUsuario` varchar(50) NOT NULL,
  PRIMARY KEY (`ocu_iCodigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Structure for the `operacion` table : 
#

CREATE TABLE `operacion` (
  `ban_iCodigo` int(11) NOT NULL,
  `ope_vcNumero` varchar(10) NOT NULL,
  `pro_vcCodigo` varchar(8) DEFAULT NULL,
  `ope_vcCodigo` varchar(24) DEFAULT NULL,
  `ope_vcNombre` varchar(50) NOT NULL DEFAULT '""',
  `ope_fMonto` float(7,2) NOT NULL DEFAULT '0.00',
  `ope_dFecha` date NOT NULL,
  `con_vcCodigo` varchar(6) NOT NULL,
  `ope_vcSecuencia` varchar(1) DEFAULT NULL,
  `ope_vcTipoDocumento` varchar(1) DEFAULT NULL,
  `ope_vcNumeroDocumento` varchar(15) DEFAULT NULL,
  `ope_iAgencia` int(3) NOT NULL,
  `ope_tHora` time NOT NULL,
  `ope_cExtorno` char(1) NOT NULL DEFAULT '0',
  `ope_dFechaSistema` datetime NOT NULL,
  `cod_vcCodigo` varchar(6) DEFAULT NULL,
  `usu_vcCodigo` varchar(25) NOT NULL,
  `sed_iCodigo` int(11) NOT NULL DEFAULT '1',
  `ope_iMedioPago` int(1) DEFAULT NULL,
  `ope_iFormaPago` int(1) DEFAULT NULL,
  `ope_vcCajero` varchar(10) DEFAULT NULL COMMENT 'es el cajero de la agencia',
  `ope_vcDigitoChequeo` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`ban_iCodigo`,`ope_vcNumero`),
  UNIQUE KEY `IDX_operacion_7` (`ope_vcCodigo`),
  KEY `fk_concepto` (`con_vcCodigo`),
  KEY `cod_vcCodigo` (`cod_vcCodigo`),
  KEY `sed_iCodigo` (`sed_iCodigo`),
  KEY `ope_vcNombre` (`ope_vcNombre`),
  CONSTRAINT `fk_operacion` FOREIGN KEY (`ban_iCodigo`) REFERENCES `banco` (`ban_iCodigo`),
  CONSTRAINT `operacion_fk` FOREIGN KEY (`cod_vcCodigo`) REFERENCES `postulante` (`cod_vcCodigo`),
  CONSTRAINT `operacion_fk1` FOREIGN KEY (`sed_iCodigo`) REFERENCES `sede` (`sed_iCodigo`),
  CONSTRAINT `operacion_ibfk_1` FOREIGN KEY (`con_vcCodigo`) REFERENCES `concepto` (`con_vcCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TRIGGER `operacion_before_ins_tr` BEFORE INSERT ON `operacion`
  FOR EACH ROW
BEGIN
    DECLARE iContador INT;
    set iContador = (select  cast(ope_vcNumero as UNSIGNED)   from operacion order by 1 desc limit 1);
    set iContador = if(iContador is null,0,iContador) + 1;
    set new.ope_vcNumero = cast(iContador as char);

END;

#
# Structure for the `operacionexonerado` table : 
#

CREATE TABLE `operacionexonerado` (
  `codexo_vcCodigo` varchar(10) NOT NULL,
  `opeexo_vcNombre` varchar(50) NOT NULL,
  `opeexo_dFecha` date NOT NULL,
  `opeexo_vcUsuario` varchar(25) NOT NULL,
  `opeexo_cAnulado` char(1) NOT NULL DEFAULT 'N',
  `cod_vcCodigo` varchar(6) DEFAULT NULL,
  `pro_vcCodigo` varchar(8) DEFAULT NULL,
  `opeexo_dtFechaSistema` datetime NOT NULL,
  PRIMARY KEY (`codexo_vcCodigo`),
  KEY `cod_vcCodigo` (`cod_vcCodigo`),
  CONSTRAINT `operacionexonerado_fk` FOREIGN KEY (`codexo_vcCodigo`) REFERENCES `codigoexonerado` (`codexo_vcCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `operacionextra` table : 
#

CREATE TABLE `operacionextra` (
  `ban_iCodigo` int(11) NOT NULL,
  `opeext_vcNumero` varchar(10) NOT NULL,
  `pro_vcCodigo` varchar(8) DEFAULT NULL,
  `opeext_vcNombre` varchar(50) NOT NULL DEFAULT '""',
  `con_vcCodigo` varchar(6) NOT NULL,
  `opeext_fMonto` float(7,2) NOT NULL DEFAULT '0.00',
  `opeext_dFecha` date NOT NULL,
  `opeext_iAgencia` int(3) NOT NULL,
  `opeext_tHora` time NOT NULL,
  `opeext_cExtorno` char(1) NOT NULL DEFAULT '0',
  `opeext_dFechaSistema` datetime NOT NULL,
  `cod_vcCodigo` varchar(6) DEFAULT NULL,
  `usu_vcCodigo` varchar(25) NOT NULL,
  `sed_iCodigo` int(11) NOT NULL DEFAULT '1',
  `opeext_iMedioPago` int(1) DEFAULT NULL,
  `opeext_iFormaPago` int(1) DEFAULT NULL,
  `opeext_vcCajero` varchar(10) DEFAULT NULL COMMENT 'es el cajero de la agencia',
  PRIMARY KEY (`opeext_vcNumero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `operacionglobal` table : 
#

CREATE TABLE `operacionglobal` (
  `ban_iCodigo` int(11) NOT NULL,
  `opeglo_vcNumero` varchar(10) NOT NULL,
  `pro_vcCodigo` varchar(8) DEFAULT NULL,
  `opeglo_vcCodigo` varchar(32) DEFAULT NULL,
  `opeglo_vcNombre` varchar(50) NOT NULL DEFAULT '""',
  `con_vcCodigo` varchar(6) NOT NULL,
  `opeglo_fMonto` float(7,2) NOT NULL DEFAULT '0.00',
  `opeglo_dFecha` date NOT NULL,
  `opeglo_vcSecuencia` varchar(6) DEFAULT NULL,
  `opeglo_vcTipoDocumento` varchar(1) DEFAULT NULL,
  `opeglo_vcNumeroDocumento` varchar(15) DEFAULT NULL,
  `opeglo_iAgencia` int(3) NOT NULL,
  `opeglo_tHora` time NOT NULL,
  `opeglo_cExtorno` char(1) NOT NULL DEFAULT '0',
  `opeglo_dFechaSistema` datetime NOT NULL,
  `cod_vcCodigo` varchar(6) DEFAULT NULL,
  `usu_vcCodigo` varchar(25) NOT NULL,
  `sed_iCodigo` int(11) NOT NULL DEFAULT '1',
  `opeglo_iMedioPago` int(1) DEFAULT NULL,
  `opeglo_iFormaPago` int(1) DEFAULT NULL,
  `opeglo_vcCajero` varchar(10) DEFAULT NULL COMMENT 'es el cajero de la agencia',
  `opeglo_vcDigitoChequeo` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`opeglo_vcNumero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TRIGGER `operacionglobal_before_ins_tr` BEFORE INSERT ON `operacionglobal`
  FOR EACH ROW
BEGIN
    DECLARE iContador INT;
    set iContador = (select  cast(opeglo_vcNumero as UNSIGNED)   from operacionglobal order by 1 desc limit 1);
    set iContador = if(iContador is null, 0 , iContador) + 1;
    set new.opeglo_vcNumero = cast(iContador as char);
END;

#
# Structure for the `pahistoria` table : 
#

CREATE TABLE `pahistoria` (
  `cod_vcCodigo` varchar(8) NOT NULL,
  `aul_iCodigo` int(10) DEFAULT NULL,
  `aul_iOrden` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`aul_iOrden`),
  KEY `IXFK_postulanteaula` (`cod_vcCodigo`),
  KEY `FK_postulanteaula_2` (`aul_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `postulanteaula` table : 
#

CREATE TABLE `postulanteaula` (
  `cod_vcCodigo` varchar(8) NOT NULL,
  `aul_iCodigo` int(10) NOT NULL,
  PRIMARY KEY (`aul_iCodigo`,`cod_vcCodigo`),
  KEY `IXFK_postulanteaula` (`cod_vcCodigo`),
  KEY `FK_postulanteaula_2` (`aul_iCodigo`),
  CONSTRAINT `FK_postulanteaula_1` FOREIGN KEY (`cod_vcCodigo`) REFERENCES `postulante` (`cod_vcCodigo`),
  CONSTRAINT `FK_postulanteaula_2` FOREIGN KEY (`aul_iCodigo`) REFERENCES `aula` (`aul_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `postulantecodigomatricula` table : 
#

CREATE TABLE `postulantecodigomatricula` (
  `cod_vcCodigo` varchar(6) DEFAULT NULL,
  `poscodmat_vcCodigo` varchar(8) NOT NULL,
  `poscodmat_vcProceso` varchar(25) DEFAULT '2014-I',
  `poscodmat_vcResolucionRectoral` varchar(50) DEFAULT '01280-R-13',
  `poscodmat_cTemporal` varchar(8) DEFAULT NULL,
  `poscodmat_cEntregado` char(1) DEFAULT 'N',
  `poscodmat_cAnulado` char(1) DEFAULT 'N',
  `poscodmat_vcMesAnio` varchar(50) DEFAULT 'Setiembre 2013',
  `poscodmat_dtFechaEntrega` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `postulantefisica` table : 
#

CREATE TABLE `postulantefisica` (
  `cod_vcCodigo` varchar(6) NOT NULL,
  `nombres` varchar(64) DEFAULT NULL,
  `pos_fNotaAptitudFisica` float(9,3) DEFAULT NULL,
  PRIMARY KEY (`cod_vcCodigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Structure for the `rango` table : 
#

CREATE TABLE `rango` (
  `proadm_vcCodigo` varchar(50) DEFAULT '20151',
  `ide_iAnonimoMinimo` bigint(20) NOT NULL DEFAULT '0',
  `cla_iCodigo` int(11) DEFAULT '0',
  `ide_iAnonimoMaximo` bigint(20) DEFAULT NULL,
  `tippru_iCodigo` int(11) DEFAULT '1',
  `gru_iCodigo` int(11) DEFAULT NULL,
  `zon_dFechaPrueba` date DEFAULT '2014-08-17',
  `ide_iAnonimoMinimoReal` bigint(20) DEFAULT '0',
  `ide_iAnonimoMaximoReal` bigint(20) DEFAULT '0',
  PRIMARY KEY (`ide_iAnonimoMinimo`),
  KEY `FK_rango_1` (`cla_iCodigo`,`tippru_iCodigo`,`zon_dFechaPrueba`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `respuesta` table : 
#

CREATE TABLE `respuesta` (
  `ide_iAnonimo` int(11) NOT NULL,
  `res_vcRespuesta` varchar(120) DEFAULT NULL,
  `res_iLectora` int(11) DEFAULT NULL,
  `res_iPosicionLectura` int(11) DEFAULT NULL,
  `aul_iCodigo` int(11) DEFAULT NULL,
  `tippru_iCodigo` int(11) DEFAULT '1',
  `zon_dFechaPrueba` date DEFAULT '2014-08-17',
  `cla_iAnonimo` int(8) DEFAULT NULL,
  `cla_iCodigo` int(11) DEFAULT NULL,
  PRIMARY KEY (`ide_iAnonimo`),
  KEY `respuesta_FKIndex2` (`ide_iAnonimo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `sededepartamento` table : 
#

CREATE TABLE `sededepartamento` (
  `sed_iCodigo` int(11) NOT NULL,
  `dep_vcCodigo` varchar(2) NOT NULL,
  PRIMARY KEY (`sed_iCodigo`,`dep_vcCodigo`),
  KEY `sed_iCodigo` (`sed_iCodigo`),
  KEY `dep_vcCodigo` (`dep_vcCodigo`),
  CONSTRAINT `sededepartamento_ibfk_1` FOREIGN KEY (`sed_iCodigo`) REFERENCES `sede` (`sed_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `sedelocalaula` table : 
#

CREATE TABLE `sedelocalaula` (
  `sed_iCodigo` int(11) DEFAULT NULL,
  `sed_vcNombre` varchar(20) DEFAULT NULL,
  `gru_iCodigo` int(11) DEFAULT NULL,
  `zon_iCodigo` int(11) DEFAULT NULL,
  `zon_vcNombre` varchar(20) DEFAULT NULL,
  `loc_iCodigo` int(11) DEFAULT NULL,
  `loc_vcNombreCorto` varchar(20) DEFAULT NULL,
  `loc_vcNombre` varchar(80) DEFAULT NULL,
  `loc_iAulas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `sedeusuario` table : 
#

CREATE TABLE `sedeusuario` (
  `sed_iCodigo` int(11) NOT NULL,
  `usu_vcLogin` varchar(25) NOT NULL,
  PRIMARY KEY (`sed_iCodigo`,`usu_vcLogin`),
  CONSTRAINT `FK_sedeusuario` FOREIGN KEY (`sed_iCodigo`) REFERENCES `sede` (`sed_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `tarifa` table : 
#

CREATE TABLE `tarifa` (
  `mod_cCodigo` char(1) NOT NULL,
  `tipins_iCodigo` int(11) NOT NULL,
  `tar_fMonto` float(13,2) NOT NULL DEFAULT '0.00',
  `tar_fMontoRezagado` float(13,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`mod_cCodigo`,`tipins_iCodigo`),
  KEY `fk_tipoinstitucion` (`tipins_iCodigo`),
  CONSTRAINT `tarifa_ibfk_1` FOREIGN KEY (`mod_cCodigo`) REFERENCES `modalidad` (`mod_cCodigo`),
  CONSTRAINT `tarifa_ibfk_2` FOREIGN KEY (`tipins_iCodigo`) REFERENCES `tipoinstitucion` (`tipins_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `terceros` table : 
#

CREATE TABLE `terceros` (
  `ter_iCodigo` int(11) NOT NULL AUTO_INCREMENT,
  `ter_vcDni` varchar(8) DEFAULT NULL,
  `ter_vcPaterno` varchar(50) NOT NULL,
  `ter_vcMaterno` varchar(50) DEFAULT NULL,
  `ter_vcNombre` varchar(50) DEFAULT NULL,
  `pro_iCodigo` int(10) unsigned NOT NULL DEFAULT '0',
  `car_iCodigo` int(11) DEFAULT NULL,
  `car_vcNombre` varchar(50) DEFAULT NULL,
  `loc_iCodigo` int(11) DEFAULT NULL,
  `loc_vcNombre` varchar(50) DEFAULT NULL,
  `ter_cCredencial` char(1) DEFAULT 'N',
  `ter_dtFechaImpresion` datetime DEFAULT NULL,
  `ter_vcNombreCompleto` varchar(150) DEFAULT NULL,
  `loc_vcPrefijo` varchar(50) DEFAULT NULL,
  `ter_vcCodigoDocente` varchar(10) DEFAULT NULL,
  `ter_iTemporal` int(11) DEFAULT NULL,
  `ter_iLoteImpresion` int(10) unsigned DEFAULT '0',
  `ter_cPago` char(1) NOT NULL DEFAULT 'N',
  `dia_vcCodigo` char(1) DEFAULT 'D' COMMENT 'puede ser S de sabado o D de domingo',
  `ter_cTipo` char(1) DEFAULT 'T' COMMENT 'Puede ser T o A trabajador o alumno',
  `depoca_iCodigo` int(11) DEFAULT '1' COMMENT 'debe yterne una dependencia oca o sino no imprime',
  PRIMARY KEY (`ter_iCodigo`,`pro_iCodigo`),
  KEY `FK_terceros_1` (`car_iCodigo`),
  KEY `dia_vcCodigo` (`dia_vcCodigo`),
  KEY `ter_cTipo` (`ter_cTipo`),
  KEY `depoca_iCodigo` (`depoca_iCodigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Structure for the `vacante` table : 
#

CREATE TABLE `vacante` (
  `esc_vcCodigo` varchar(5) NOT NULL,
  `mod_cCodigo` char(1) NOT NULL,
  `vac_iCantidad` int(11) DEFAULT NULL,
  `vac_iTotal` int(11) DEFAULT NULL,
  PRIMARY KEY (`esc_vcCodigo`,`mod_cCodigo`),
  KEY `fk_modalidad` (`mod_cCodigo`),
  CONSTRAINT `vacante_ibfk_1` FOREIGN KEY (`mod_cCodigo`) REFERENCES `modalidad` (`mod_cCodigo`),
  CONSTRAINT `vacante_ibfk_2` FOREIGN KEY (`esc_vcCodigo`) REFERENCES `escuela` (`esc_vcCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `vacantecalificacion` table : 
#

CREATE TABLE `vacantecalificacion` (
  `mod_cCodigo` char(1) NOT NULL,
  `esc_vcCodigo` varchar(5) NOT NULL,
  `vac_iConsolidado` int(11) NOT NULL,
  `vac_iIngresantes` int(11) DEFAULT NULL,
  `vac_iPuntajeMinimo` float DEFAULT NULL,
  `vac_iPuntajeMaximo` float DEFAULT NULL,
  PRIMARY KEY (`mod_cCodigo`,`esc_vcCodigo`),
  KEY `vacantecalificacion_FKIndex1` (`esc_vcCodigo`,`mod_cCodigo`),
  CONSTRAINT `vacantecalificacion_ibfk_1` FOREIGN KEY (`esc_vcCodigo`, `mod_cCodigo`) REFERENCES `vacante` (`esc_vcCodigo`, `mod_cCodigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `zonagrupo` table : 
#

CREATE TABLE `zonagrupo` (
  `sed_iCodigo` int(11) NOT NULL,
  `zon_iCodigo` int(11) NOT NULL,
  `gru_iCodigo` int(11) NOT NULL,
  `zongru_iCodigo` int(11) DEFAULT NULL,
  PRIMARY KEY (`sed_iCodigo`,`zon_iCodigo`,`gru_iCodigo`),
  KEY `sed_iCodigo` (`sed_iCodigo`,`zon_iCodigo`),
  KEY `gru_iCodigo` (`gru_iCodigo`),
  CONSTRAINT `zonagrupo_fk` FOREIGN KEY (`sed_iCodigo`, `zon_iCodigo`) REFERENCES `zona` (`sed_iCodigo`, `zon_iCodigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `zonagrupo_fk1` FOREIGN KEY (`gru_iCodigo`) REFERENCES `grupo` (`gru_iCodigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

